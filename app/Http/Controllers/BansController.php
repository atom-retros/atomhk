<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use Illuminate\Http\Request;

class BansController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Ban::class, 'ban');
    }

    public function index()
    {
        return view('bans.index', [
            'bans' => Ban::query()
                ->orderByDesc('id')
                ->with(['user:id,username,look', 'issuer:id,username'])
                ->paginate(15)
        ]);
    }

    public function destroy(Ban $ban)
    {
        // Find all bans on the user & delete them
        Ban::query()->where('user_id', $ban->user_id)->delete();

        return to_route('bans.index')->with('success', 'The user has been unbanned');
    }
}
