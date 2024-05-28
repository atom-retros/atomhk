<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordFormRequest;
use App\Models\User;
use App\Services\RconService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends Controller
{
    public function edit(User $user)
    {
        if (!hasPermission('reset_user_password') || !Auth::user()?->canEditUser($user)) {
            abort(403);
        }

        return view('users.edit-password', [
            'user' => $user
        ]);
    }

    public function update(UpdatePasswordFormRequest $request, User $user, RconService $rconService)
    {
        if (!hasPermission('reset_user_password') || !Auth::user()?->canEditUser($user)) {
            abort(403);
        }

        if (!$rconService->isConnected()) {
            return back()->withErrors('The RCON connection could not be established!');
        }

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        if ($user->online) {
            $rconService->disconnectUser($user);
        }

        $user->sessions()->delete();

        return to_route('users.index')->with('success', __('The user password has been updated!'));
    }
}
