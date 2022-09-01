<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatalogPageRequest;
use App\Models\CatalogPage;
use Illuminate\Http\Request;

class CatalogPagesController extends Controller
{
    public function index()
    {
        return view('catalog.pages.index', [
            'pages' => CatalogPage::query()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('catalog.pages.create');
    }

    public function store(CatalogPageRequest $request)
    {
        CatalogPage::query()->create([
            'parent_id' => $request->input('parent_id'),
            'caption' => $request->input('caption'),
            'visible' => $request->input('visible'),
            'enabled' => $request->input('enabled'),
            'page_layout' => $request->input('page_layout'),
            'icon_image' => $request->input('icon_image'),
            'min_rank' => $request->input('min_rank'),
            'order_num' => $request->input('order_num'),
            'page_headline' => $request->input('page_headline'),
            'page_teaser' => $request->input('page_teaser'),
            'page_text1' => $request->input('page_text1'),
            'page_text2' => $request->input('page_text2'),
            'page_text_details' => $request->input('page_text_details'),
        ]);

        return to_route('catalog-pages.index')->with('success', 'The catalog page has been created!');
    }

    public function show(CatalogPage $catalogPage)
    {
    }

    public function edit(CatalogPage $catalogPage)
    {
    }

    public function update(Request $request, CatalogPage $catalogPage)
    {
    }

    public function destroy(CatalogPage $catalogPage)
    {
    }
}