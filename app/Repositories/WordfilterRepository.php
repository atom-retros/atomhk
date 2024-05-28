<?php

namespace App\Repositories;

use App\Models\Wordfilter;
use App\Services\RconService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;

class WordfilterRepository
{
    public function __construct(private readonly RconService $rconService)
    {
    }

    public function fetchAll(): LengthAwarePaginator
    {
        return Wordfilter::query()->paginate(15);
    }

    public function store(array $data): void
    {
        Wordfilter::create($data);
    }

    public function update(Wordfilter $key, array $data): void
    {
        $key->update($data);
    }

    public function delete(Wordfilter $key): void
    {
        $key->delete();
    }

    public function updateWordFilterRcon(): RedirectResponse
    {
        if (!hasPermission('manage_wordfilter')) {
            abort(401);
        }

        if (!$this->rconService->isConnected()) {
            return redirect()->back()->withErrors([
                'message' => __('The RCON connection could not be established!')
            ]);
        }

        $this->rconService->updateWordFilter();

        return redirect()->back()->with('success', 'RCON executed! The word filter has been updated live on the hotel');
    }
}
