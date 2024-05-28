<?php

namespace App\Http\Controllers;

use App\Models\CatalogItem;
use App\Models\CatalogPage;

class CatalogItemController extends Controller
{
    public function edit(CatalogItem $item)
    {
        $itemFurnidata = json_decode(file_get_contents(public_path(setting('nitro_furnidata_path'))), true);
        $itemType = 'invalid';

        if ($item->itemBase->type === 's') {
            $itemType = 'roomitemtypes';
        }

        if ($item->itemBase->type === 'i') {
            $itemType = 'wallitemtypes';
        }

        if ($itemType !== 'invalid') {
            $itemData = $itemFurnidata[$itemType]['furnitype'];

            $itemData = array_filter($itemData, function ($data) use ($item) {
                return $data['id'] === $item->itemBase->sprite_id;
            });
        }

        // Flat the array but keep it keys as the name instead of being number key based
        $itemData = collect($itemData)->mapWithKeys(function ($item) {
            return ['furni' => $item];
        });

        return view('catalog.items.edit', [
            'item' => $item->load('itemBase', 'catalogPage'),
            'pages' => CatalogPage::query()->whereNot('id', $item->page_id)->get(),
            'furnidata' => $itemData ?? [],
        ]);
    }
}
