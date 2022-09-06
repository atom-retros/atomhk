<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebsiteWhitelistRequest;
use App\Models\WebsiteIpWhitelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteIpWhitelistsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(WebsiteIpWhitelist::class, 'websiteIpWhitelist');
    }

    public function index()
    {
        return view('website.whitelists.index', [
            'whitelists' => WebsiteIpWhitelist::query()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('website.whitelists.create');
    }

    public function store(WebsiteWhitelistRequest $request)
    {
        WebsiteIpWhitelist::query()->create($request->validated());

        return to_route('website-whitelist.index')->with('success', __('The IP has been whitelisted!'));
    }

    public function edit(WebsiteIpWhitelist $websiteIpWhitelist)
    {
        return view('website.whitelists.edit', [
            'whitelist' => $websiteIpWhitelist,
        ]);
    }

    public function update(WebsiteWhitelistRequest $request, WebsiteIpWhitelist $websiteIpWhitelist)
    {
        $websiteIpWhitelist->update($request->validated());

        return to_route('website-whitelist.index')->with('success', __('The IP whitelist has been updated!'));
    }

    public function destroy(WebsiteIpWhitelist $websiteIpWhitelist)
    {
        $websiteIpWhitelist->delete();

        return to_route('website-whitelist.index')->with('success', __('The whitelisted IP has been removed!'));
    }

    public function search(Request $request)
    {
        if (!hasPermission(Auth::user(), 'manage_website_whitelists')) {
            abort(403);
        }

        $criteria = addslashes($request->get('criteria'));

        return view('website.whitelists.index', [
            'whitelists' => WebsiteIpWhitelist::query()
                ->where('ip_address', 'like', '%' . $criteria . '%')
                ->paginate(15),
        ]);
    }
}