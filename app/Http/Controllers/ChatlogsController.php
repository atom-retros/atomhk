<?php

namespace App\Http\Controllers;


use App\Http\Requests\RoomChatlogsSearchFormRequest;
use App\Models\ChatlogRoom;
use App\Models\Room;
use App\Models\User;

class ChatlogsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ChatlogRoom::class);
    }

    public function index()
    {
        return view('chatlogs.room', [
            'chatlogs' => ChatlogRoom::query()
                ->latest('timestamp')
                ->with(['user:id,username,look', 'room'])
                ->paginate(15),
        ]);
    }

    public function search(RoomChatlogsSearchFormRequest $request) {
        $input = $request->get('search_input');

        return match ($request->get('sort_by')) {
            'word' => $this->sortByWord($input),
            'users' => $this->sortByUsers($input),
            'rooms' => $this->sortByRooms($input),

            default => $this->index(),
        };
    }

    private function sortByWord($input)
    {
        return view('chatlogs.room', [
            'chatlogs' => ChatlogRoom::query()
                ->where('message', 'like', '%' . $input . '%')
                ->latest('timestamp')
                ->with(['user:id,username,look', 'room:id,name'])
                ->paginate(15),
        ]);
    }

    private function sortByUsers($input)
    {
        $enteredUsers = explode(',', $input);

        $users = User::query()
            ->select('id')
            ->whereIn('username', $enteredUsers)
            ->get()
            ->toArray();

        return view('chatlogs.room', [
            'chatlogs' =>  ChatlogRoom::query()
                ->whereIn('user_from_id', $users)
                ->latest('timestamp')
                ->with(['user:id,username,look', 'room'])
                ->paginate(15),
        ]);
    }

    public function sortByRooms($input)
    {
        $room = Room::query()
            ->select('id')
            ->where('name', 'like', '%' . $input . '%')
            ->get()
            ->pluck('id')
            ->toArray();

        if (count($room) === 0) {
            return redirect()->back()->withErrors(__('The room you entered was not found'));
        }

        return view('chatlogs.room', [
            'chatlogs' => ChatlogRoom::query()
                ->whereIn('room_id', $room)
                ->latest('timestamp')
                ->with(['user:id,username,look', 'room'])
                ->paginate(15),
        ]);
    }
}