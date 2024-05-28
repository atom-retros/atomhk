<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordfilterFormRequest;
use App\Models\Wordfilter;
use App\Repositories\WordfilterRepository;
use App\Services\RconService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class WordfilterController extends Controller
{
    public function __construct(private readonly WordfilterRepository $wordfilterRepository)
    {
        $this->authorizeResource(Wordfilter::class, 'key');
    }

    public function index()
    {
        return view('wordfilter.index', [
            'words' => $this->wordfilterRepository->fetchAll(),
        ]);
    }

    public function create()
    {
        return view('wordfilter.create');
    }

    public function store(WordfilterFormRequest $request): RedirectResponse
    {
        $this->wordfilterRepository->store($request->validated());

        return to_route('wordfilter.index')
            ->with('success', __(':word has been added to the wordfilter', ['word' => $request->input('key')]));
    }

    public function edit(Wordfilter $key)
    {
        return view('wordfilter.edit', [
            'word' => $key,
        ]);
    }

    public function update(Wordfilter $key, WordfilterFormRequest $request)
    {
        $this->wordfilterRepository->update($key, $request->validated());

        return to_route('wordfilter.index')
            ->with('success', __(':word has been updated in the wordfilter', ['word' => $request->input('key')]));
    }

    public function destroy(Wordfilter $key)
    {
        $this->wordfilterRepository->delete($key);

        return to_route('wordfilter.index')
            ->with('success', __(':word has been deleted from the wordfilter', ['word' => $key->key]));
    }

    public function updateFilterRcon(): RedirectResponse
    {
        return $this->wordfilterRepository->updateWordFilterRcon();
    }
}
