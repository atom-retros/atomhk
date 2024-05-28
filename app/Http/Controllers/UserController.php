<?php

namespace App\Http\Controllers;

use App\Actions\UpdateUserThroughRcon;
use App\Actions\UpdateUserWithoutRcon;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserSearchFormRequest;
use App\Models\Permission;
use App\Models\User;
use App\Repositories\PermissionRepository;
use App\Repositories\UserRepository;
use App\Services\RconService;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UserController extends Controller
{
    public function __construct(private readonly UserRepository $userRepository, private readonly PermissionRepository $permissionRepository)
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        return view('users.index', [
            'users' => $this->userRepository->fetchAll(),
        ]);
    }

    public function edit(User $user)
    {
        if (!Auth::user()?->canEditUser($user)) {
            abort(403);
        }

        return view('users.edit', [
            'user' => $user->load(['permission:id,rank_name']),
            'ranks' => $this->permissionRepository->fetchAllExceptRank($user->rank),

        ]);
    }

    public function update(UpdateUserRequest $request, User $user, RconService $rconService)
    {
        if(!Auth::user()?->canEditUser($user)) {
            abort(403);
        }

        if (!$rconService->isConnected()) {
            $updateWithoutRcon = new UpdateUserWithoutRcon($request, $user);
            if (!$updateWithoutRcon->execute()) {
                return redirect()->back()->withErrors([
                    'message' => __('Failed to update user.')
                ]);
            }
        } else {
            $updateThroughRcon = new UpdateUserThroughRcon($request, $user, $rconService);
            $updateThroughRcon->execute();
        }

        return redirect()->route('users.edit', $user)->with('success', 'The user has been updated!');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function destroy(User $user, RconService $rconService)
    {
        if(!Auth::user()?->canEditUser($user)) {
            abort(403);
        }

        if ($user->id === Auth::id()) {
            return redirect()->back()->withErrors([
                'message' => __('You cannot delete your own account.')
            ]);
        }

        if ($rconService->isConnected() && $user->online) {
            $rconService->disconnectUser($user);
            sleep(1);
        }

        $user->delete();

        return redirect()->route('users.index', ['page' => request()?->get('page', 1)])->with(
            'success',
            __('The user has been deleted')
        );
    }

    public function search(UserSearchFormRequest $request)
    {
        return view('users.index', [
            'users' => User::query()
                ->select(['id', 'username', 'mail', 'motto', 'rank', 'look', 'online', 'ip_current', 'last_online'])
                ->where('username', 'like', '%' . $request->input('username') . '%')
                ->paginate(15),
        ]);
    }

    public function clones(User $user)
    {
        return view('users.index', [
            'users' => User::query()
                ->select(['id', 'username', 'mail', 'motto', 'rank', 'look', 'online', 'ip_current', 'last_online'])
                ->whereIn('ip_current', [$user->ip_current, $user->ip_register])
                ->orWhereIn('ip_register', [$user->ip_current, $user->ip_register])
                ->paginate(15),
        ]);
    }
}
