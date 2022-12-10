<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebsiteSettingRequest;
use App\Http\Requests\WebsiteSettingUpdateRequest;
use App\Models\EmulatorSetting;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteSettingsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', WebsiteSetting::class);

        return view('website.settings.index', [
            'settings'  => WebsiteSetting::query()
                ->select('id', 'key as setting', 'value', 'comment')
                ->paginate(15),
        ]);
    }

    public function create()
    {
        $this->authorize('create', WebsiteSetting::class);

        return view('website.settings.create');
    }

    public function store(WebsiteSettingRequest $request)
    {
        $this->authorize('create', WebsiteSetting::class);

        WebsiteSetting::query()->create($request->validated());

        return to_route('website-settings.index')->with('success', __('The website setting has been created!'));
    }

    public function edit(string $websiteSetting)
    {
        $this->authorize('update', WebsiteSetting::class);

        $setting = WebsiteSetting::query()
            ->select('id', 'key as setting', 'value', 'comment')
            ->where('id', '=', $websiteSetting)
            ->firstOrFail();

        return view('website.settings.edit', [
            'setting' => $setting,
        ]);
    }

    public function update(WebsiteSettingUpdateRequest $request, WebsiteSetting $websiteSetting)
    {
        $this->authorize('update', $websiteSetting);

        $websiteSetting->update($request->validated());

        return to_route('website-settings.index')->with('success', __('The website setting has been updated!'));
    }

    public function destroy(WebsiteSetting $websiteSetting)
    {
        $this->authorize('update', $websiteSetting);

        $websiteSetting->delete();

        return to_route('website-settings.index')->with('success', __('The website setting has been deleted!'));
    }

    public function search(Request $request)
    {
        if (!hasPermission('manage_website_settings')) {
            abort(401);
        }

        $criteria = addslashes($request->get('criteria'));

        return view('website.settings.index', [
            'settings' => WebsiteSetting::query()
                ->select('id', 'key as setting', 'value', 'comment')
                ->where('key', 'like', '%' . $criteria . '%')
                ->paginate(15),
        ]);
    }
}