<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebsiteBlacklistRequest;
use App\Models\WebsiteIpBlacklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteIpBlacklistsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(WebsiteIpBlacklist::class, 'websiteIpBlacklist');
    }

    public function index()
    {
        return view('website.blacklists.index', [
            'blacklists' => WebsiteIpBlacklist::query()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('website.blacklists.create');
    }

    public function store(WebsiteBlacklistRequest $request)
    {
        WebsiteIpBlacklist::query()->create($request->validated());

        return to_route('website-blacklist.index')->with('success', __('The IP has been blacklisted!'));
    }

    public function edit(WebsiteIpBlacklist $websiteIpBlacklist)
    {
        return view('website.blacklists.edit', [
            'blacklist' => $websiteIpBlacklist,
        ]);
    }

    public function update(WebsiteBlacklistRequest $request, WebsiteIpBlacklist $websiteIpBlacklist)
    {
        $websiteIpBlacklist->update($request->validated());

        return to_route('website-blacklist.index')->with('success', __('The blacklist has been updated!'));
    }

    public function destroy(WebsiteIpBlacklist $websiteIpBlacklist)
    {
        $websiteIpBlacklist->delete();

        return to_route('website-blacklist.index')->with('success', __('The blacklisted IP has been removed!'));
    }

    public function search(Request $request)
    {
        if (!hasPermission(Auth::user(), 'manage_website_blacklists')) {
            abort(403);
        }

        $criteria = addslashes($request->get('criteria'));

        return view('website.blacklists.index', [
            'blacklists' => WebsiteIpBlacklist::query()
                ->where('ip_address', 'like', '%' . $criteria . '%')
                ->paginate(15),
        ]);
    }
}