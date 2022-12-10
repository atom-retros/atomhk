<?php

namespace App\Http\Controllers;

use App\Models\CatalogPage;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogPageSearchController extends Controller
{
    public function search(Request $request): View
    {
        if (!hasPermission('manage_catalog_pages')) {
            abort(401);
        }

        $criteria = addslashes($request->get('criteria'));
        $pages = match (addslashes($request->get('sort_by'))) {
            'parent_ids' => $this->parentIds($criteria),
            'captions' => $this->captions($criteria),
            'page_layouts' => $this->pageLayouts($criteria),
            default => $this->pageIds($criteria),
        };

        return view('catalog.pages.index', [
            'pages' => $pages,
        ]);
    }

    private function pageIds(string $searchQuery)
    {
        return CatalogPage::query()
            ->whereIn('id', explode(',', $searchQuery))
            ->paginate(15);
    }

    private function parentIds(string $searchQuery)
    {
        return CatalogPage::query()
            ->whereIn('parent_id', explode(',', $searchQuery))
            ->paginate(15);
    }

    private function captions(string $searchQuery)
    {
        return CatalogPage::query()
            ->whereIn('caption', explode(',', $searchQuery))
            ->paginate(15);
    }

    private function pageLayouts(string $searchQuery)
    {
        return CatalogPage::query()
            ->whereIn('page_layout', explode(',', $searchQuery))
            ->paginate(15);
    }
}