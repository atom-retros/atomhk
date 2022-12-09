<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatalogPageRequest;
use App\Models\CatalogPage;
use Illuminate\Http\Request;

class CatalogPagesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(CatalogPage::class, 'catalogPage');
    }

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
            'page_text_details' => clean($request->input('page_text_details')),
        ]);

        return to_route('catalog-pages.index')->with('success', 'The catalog page has been created!');
    }

    public function edit(CatalogPage $catalogPage)
    {
        return view('catalog.pages.edit', [
            'page' => $catalogPage
        ]);
    }

    public function update(CatalogPageRequest $request, CatalogPage $catalogPage)
    {
        $catalogPage->update([
            'parent_id' => $request->input('parent_id'),
            'caption' => $request->input('caption'),
            'visible' => $request->input('visible'),
            'enabled' => $request->input('enabled'),
            'page_layout' => $request->input('page_layout'),
            'icon_image' => $request->input('icon_image'),
            'min_rank' => $request->input('min_rank'),
            'order_num' => $request->input('order_num'),
            'page_headline' => $request->input('page_headline') ?? '',
            'page_teaser' => $request->input('page_teaser') ?? '',
            'page_text1' => $request->input('page_text1'),
            'page_text2' => $request->input('page_text2'),
            'page_text_details' => clean($request->input('page_text_details')),
        ]);

        return to_route('catalog-pages.index')->with('success', 'The catalog page has been updated!');
    }

    public function destroy(CatalogPage $id)
    {
        dd($id);

        $id->delete();

        return redirect()->back()->with('success', 'The catalog page has been removed!');
    }
}