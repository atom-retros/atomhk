<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmulatorTextsRequest;
use App\Models\EmulatorSetting;
use App\Models\EmulatorText;
use App\Services\RconService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EmulatorTextsController extends Controller
{
    public function index()
    {
        $this->authorize(EmulatorText::class);

        return view('emulator.texts.index', [
            'texts' => EmulatorText::query()
                ->select('key as text', 'value')
                ->paginate(15),
        ]);
    }

    public function create()
    {
        $this->authorize(EmulatorText::class);

        return view('emulator.texts.create');
    }

    public function store(EmulatorTextsRequest $request)
    {
        $this->authorize(EmulatorText::class);

        EmulatorText::query()->create([
            'key' => $request->input('text'),
            'value' => $request->input('value'),
        ]);

        return to_route('emulator-texts.index')
            ->with('success', 'The emulator text has been created!');
    }

    public function edit(string $text)
    {
        $this->authorize(EmulatorText::class);

        return view('emulator.texts.edit', [
            'text' => EmulatorText::query()
                ->select('key as text', 'value')
                ->where('key', '=', $text)
                ->firstOrFail(),
        ]);
    }

    public function update(EmulatorTextsRequest $request, EmulatorText $text)
    {
        $this->authorize(EmulatorText::class);

        $text->update([
            'key' => $request->input('text'),
            'value' => $request->input('value'),
        ]);

        return to_route('emulator-texts.index')
            ->with('success', 'The emulator text has been updated!');
    }

    public function destroy(EmulatorText $text)
    {
        $this->authorize(EmulatorText::class);

        $text->delete();

        return redirect()
            ->back()
            ->with('success', 'The emulator text has been removed!');
    }

    public function search(Request $request)
    {
        $criteria = addslashes($request->get('criteria'));

        return view('emulator.texts.index', [
            'texts' => EmulatorText::query()
                ->select('key as text', 'value')
                ->where('key', 'like', '%' . $criteria . '%')
                ->paginate(15),
        ]);
    }

    public function updateEmulatorTextsRcon(RconService $rcon)
    {
        if (!hasPermission(Auth::user(), 'manage_emulator_settings')) {
            abort(403);
        }

        $rcon->updateConfig(Auth::user(), ':update_texts');

        return redirect()
            ->back()
            ->with('success', 'RCON executed! If you have the ":update_texts" permission in-game, the emulator texts changes will now be live on the hotel.');
    }
}