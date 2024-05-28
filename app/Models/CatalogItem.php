<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogItem extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function catalogPage(): BelongsTo
    {
        return $this->belongsTo(CatalogPage::class, 'page_id', 'id');
    }

    public function itemBase(): BelongsTo
    {
        return $this->belongsTo(ItemBase::class, 'item_ids', 'sprite_id');
    }
}
