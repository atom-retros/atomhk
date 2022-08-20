<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatlogsSearchFormRequest;
use App\Models\ChatlogPrivate;
use App\Models\User;

class PrivateChatlogsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ChatlogPrivate::class);
    }

    public function index()
    {
        return view('chatlogs.private', [
            'chatlogs' => ChatlogPrivate::query()
                ->latest('timestamp')
                ->with(['sender:id,username', 'receiver:id,username'])
                ->paginate(15),
        ]);
    }

    public function search(ChatlogsSearchFormRequest $request)
    {
        $input = strip_tags(addslashes($request->get('search_input')));

        return match ($request->get('sort_by')) {
            'sender' => $this->sortBySender($input),
            'receiver' => $this->sortByReceiver($input),
            'word' => $this->sortByWord($input),

            default => $this->index(),
        };
    }

    private function sortBySender($input)
    {
        $user = User::query()
            ->select('id', 'username')
            ->where('username' ,'=', $input)
            ->first();

        if (is_null($user)) {
            return redirect()->back()->withErrors(__('No records found'));
        }

        return view('chatlogs.private', [
            'chatlogs' => $user->privateChatlogsSent()->latest('timestamp')->paginate(15),
        ]);
    }

    private function sortByReceiver($input)
    {
        $user = User::query()
            ->select('id', 'username')
            ->where('username' ,'=', $input)
            ->first();

        if (is_null($user)) {
            return redirect()->back()->withErrors(__('No records found'));
        }

        return view('chatlogs.private', [
            'chatlogs' => $user->privateChatlogsReceived()->latest('timestamp')->paginate(15),
        ]);
    }

    private function sortByWord($input)
    {
        $chatlogs = ChatlogPrivate::query()
            ->where('message' ,'like', '%' . $input . '%')
            ->latest('timestamp')
            ->with(['sender:id,username', 'receiver:id,username'])
            ->paginate(15);

        if (!$chatlogs->count() > 0) {
            return redirect()->back()->withErrors(__('No records found'));
        }

        return view('chatlogs.private', [
            'chatlogs' => $chatlogs,
        ]);
    }
}