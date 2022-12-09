<?php

namespace App\Actions;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UpdateUserWithoutRcon
{
    public function __construct(
        private UpdateUserRequest $request,
        private User $user
    ) {
    }

    public function execute(): bool
    {
        if ($this->user->online) {
            return false;
        }

        if ($this->user->username !== $this->request->input('username')) {
            $this->user->update([
                'username' => $this->request->input('username'),
            ]);
        }

        if ($this->user->motto !== $this->request->input('motto')) {
            $this->user->update([
                'motto' => $this->request->input('motto'),
            ]);
        }

        if ($this->user->rank !== $this->request->input('rank')) {
            $this->user->update([
                'rank' => $this->request->input('rank'),
            ]);
        }

        if ($this->user->credits != $this->request->input('credits')) {
            $total = (0 - $this->user->credits) + $this->request->input('credits');

            $this->user->update([
                'credits' => $this->user->credits + $total,
            ]);
        }

        if ($this->user->currency('duckets') != $this->request->input('duckets')) {
            $total = (0 - $this->user->currency('duckets')) + $this->request->input('duckets');

            $this->user->updateCurrency('duckets', $total);
        }

        if ($this->user->currency('diamonds') != $this->request->input('diamonds')) {
            $total = (0 - $this->user->currency('diamonds')) + $this->request->input('diamonds');

            $this->user->updateCurrency('diamonds', $total);
        }

        if ($this->user->currency('points') != $this->request->input('points')) {
            $total = (0 - $this->user->currency('points')) + $this->request->input('points');

            $this->user->updateCurrency('points', $total);
        }

        return true;
    }
}