<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserSearchFormRequest;
use App\Models\Permission;
use App\Models\User;
use App\Services\RconService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        return view('users.index', [
            'users' => User::query()
                ->select(['id', 'username', 'mail', 'motto', 'rank', 'look', 'online', 'ip_current', 'last_online'])
                ->orderByDesc('id')
                ->paginate(15),
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user->load(['permission']),
            'ranks' =>  Permission::query()->where('id', '!=', $user->rank)->get(),

        ]);
    }

    public function update(UpdateUserRequest $request, User $user, RconService $rcon)
    {
        if ($user->username !== $request->input('username')) {
            if ($user->online) {
                $rcon->disconnectUser($user);
                sleep(2);
            }

            $user->update([
                'username' => $request->input('username'),
            ]);
        }

        if ($user->motto !== $request->input('motto') && $user->online === '1') {
            $rcon->setMotto($user, $request->input('motto'));
        } else {
            $user->update([
                'motto' => $request->input('motto'),
            ]);
        }

        if ($user->online == '1') {
            $rcon->alertUser($user, 'Your rank has been updated, you will therefore be disconnected. You can log back in at anytime!');
            sleep(2);

            $rcon->disconnectUser($user);
        }

        $rcon->setRank($user, $request->input('rank'));

        if ($user->credits != $request->input('credits')) {
            $total = (0 - $user->credits) + $request->input('credits');
            $rcon->giveCredits($user, $total);
        }

        if ($user->currency('duckets') != $request->input('duckets')) {
            $total = (0 - $user->currency('duckets')) + $request->input('duckets');
            $rcon->giveDuckets($user, $total);
        }

        if ($user->currency('diamonds') != $request->input('diamonds')) {
            $total = (0 - $user->currency('diamonds')) + $request->input('diamonds');
            $rcon->giveDiamonds($user, $total);
        }

        if ($user->currency('points') != $request->input('points')) {
            $total = (0 - $user->currency('points')) + $request->input('points');
            $rcon->giveGotw($user, $total);
        }

        return redirect()->route('users.edit', $user)->with('success', 'The user has been updated!');
    }

    public function destroy(User $user, RconService $rcon)
    {
        if ($user->online) {
            $rcon->disconnectUser($user);
            sleep(2);
        }

        $user->delete();

        return redirect()->route('users.index', ['page' => request()->get('page', 1)])->with('success', __('The user has been deleted'));
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
}
