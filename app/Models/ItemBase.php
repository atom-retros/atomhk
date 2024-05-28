<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemBase extends Model
{
    protected $table = 'items_base';

    protected $guarded = [];

    public $timestamps = false;

    public function catalogItems(): HasMany
    {
        return $this->hasMany(CatalogItem::class, 'item_ids', 'sprite_id');
    }
}
