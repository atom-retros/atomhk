<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends Controller
{
    public function edit(User $user)
    {
        if (!hasPermission('reset_user_password')) {
            abort(401);
        }

        return view('users.edit-password', [
            'user' => $user
        ]);
    }

    public function update(UpdatePasswordFormRequest $request, User $user)
    {
        if (!hasPermission('reset_user_password')) {
            abort(401);
        }

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return to_route('users.index')->with('success', __('The user password has been updated!'));
    }
}