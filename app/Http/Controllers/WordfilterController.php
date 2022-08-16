<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordfilterFormRequest;
use App\Models\Wordfilter;
use App\Services\RconService;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WordfilterController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Wordfilter::class, 'key');
    }

    public function index()
    {
        return view('wordfilter.index', [
            'words' => Wordfilter::query()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('wordfilter.create');
    }

    public function store(WordfilterFormRequest $request, RconService $rcon)
    {
        Wordfilter::create($request->validated());
        $rcon->updateWordFilter(); // Refresh the wordfilter

        return to_route('wordfilter.index')
            ->with('success', __(':word has been added to the wordfilter', ['word' => $request->input('key')]));
    }

    public function edit(Wordfilter $key)
    {
        return view('wordfilter.edit', [
            'word' => $key,
        ]);
    }

    public function update(Wordfilter $key, WordfilterFormRequest $request, RconService $rcon)
    {
        $key->update($request->validated());

        return to_route('wordfilter.index')
            ->with('success', __(':word has been updated in the wordfilter', ['word' => $request->input('key')]));
    }

    public function destroy(Wordfilter $key, RconService $rcon)
    {
        $key->delete();
        $rcon->updateWordFilter(); // Refresh the wodfilrter

        return to_route('wordfilter.index')
            ->with('success', __(':word has been deleted from the wordfilter', ['word' => $key->key]));
    }
}
