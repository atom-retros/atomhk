<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmulatorSettingsRequest;
use App\Models\EmulatorSetting;

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
}