<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmulatorSettingsRequest;
use App\Models\EmulatorSetting;
use App\Services\RconService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EmulatorSettingsController extends Controller
{
    public function index()
    {
        $this->authorize(EmulatorSetting::class);

        return view('emulator.index', [
            'settings' => EmulatorSetting::query()->select('key as setting', 'value')->paginate(15),
        ]);
    }

    public function create()
    {
        $this->authorize(EmulatorSetting::class);

        return view('emulator.create');
    }

    public function store(EmulatorSettingsRequest $request)
    {
        $this->authorize(EmulatorSetting::class);

        EmulatorSetting::query()->create([
            'key' => $request->input('setting'),
            'value' => $request->input('value'),
        ]);

        return to_route('emulator-settings.index')->with('success', 'The emulator setting has been created!');
    }

    public function edit(string $setting)
    {
        $this->authorize(EmulatorSetting::class);

        return view('emulator.edit', [
            'setting' => EmulatorSetting::query()->select('key as setting', 'value')->where('key', '=', $setting)->firstOrFail(),
        ]);
    }

    public function update(EmulatorSettingsRequest $request, EmulatorSetting $setting)
    {
        $this->authorize(EmulatorSetting::class);

        $setting->update([
           'key' => $request->input('setting'),
           'value' => $request->input('value'),
        ]);

        return to_route('emulator-settings.index')->with('success', 'The emulator setting has been updated!');
    }

    public function destroy(EmulatorSetting $setting)
    {
        $this->authorize(EmulatorSetting::class);

        $setting->delete();

        return redirect()->back()->with('success', 'The emulator setting has been removed!');
    }

    public function search(Request $request)
    {
        $criteria = addslashes($request->get('criteria'));

        return view('emulator.index', [
            'settings' => EmulatorSetting::query()
                ->select('key as setting', 'value')
                ->where('key', 'like', '%' . $criteria . '%')
                ->paginate(15),
        ]);
    }

    public function updateRcon(RconService $rcon)
    {
        if (!hasPermission(Auth::user(), 'manage_emulator_settings')) {
            abort(403);
        }

        $rcon->updateConfig(Auth::user(), ':update_config');

        return redirect()->back()->with('success', 'RCON executed! If you have the ":update_config" permission in-game, the emulator settings changes will now be live on the hotel.');
    }
}