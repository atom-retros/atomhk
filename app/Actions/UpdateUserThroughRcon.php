<?php

namespace App\Actions;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\RconService;

class UpdateUserThroughRcon
{
    public function __construct(
        private UpdateUserRequest $request,
        private User $user,
        private RconService $rconService
    ) {
    }

    public function execute(): void
    {
        if ($this->user->username !== $this->request->input('username')) {
            if ($this->user->online) {
                $this->rconService->disconnectUser($this->user);
                sleep(2);
            }

            $this->user->update([
                'username' => $this->request->input('username'),
            ]);
        }

        if ($this->user->motto !== $this->request->input('motto') && $this->user->online === '1') {
            $this->rconService->setMotto($this->user, $this->request->input('motto'));
        } else {
            $this->user->update([
                'motto' => $this->request->input('motto'),
            ]);
        }

        if ($this->user->online == '1') {
            $this->rconService->alertUser(
                $this->user,
                'Your rank has been updated, you will therefore be disconnected. You can log back in at anytime!'
            );

            sleep(2);
            $this->rconService->disconnectUser($this->user);
        }

        $this->rconService->setRank($this->user, $this->request->input('rank'));

        if ($this->user->credits != $this->request->input('credits')) {
            $total = (0 - $this->user->credits) + $this->request->input('credits');
            $this->rconService->giveCredits($this->user, $total);
        }

        if ($this->user->currency('duckets') != $this->request->input('duckets')) {
            $total = (0 - $this->user->currency('duckets')) + $this->request->input('duckets');
            $this->rconService->giveDuckets($this->user, $total);
        }

        if ($this->user->currency('diamonds') != $this->request->input('diamonds')) {
            $total = (0 - $this->user->currency('diamonds')) + $this->request->input('diamonds');
            $this->rconService->giveDiamonds($this->user, $total);
        }

        if ($this->user->currency('points') != $this->request->input('points')) {
            $total = (0 - $this->user->currency('points')) + $this->request->input('points');
            $this->rconService->giveGotw($this->user, $total);
        }
    }
}