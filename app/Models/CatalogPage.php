<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CatalogPage extends Model
{
    use LogsActivity;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function items(): HasMany
    {
        return $this->hasMany(CatalogItem::class, 'page_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'parent_id', 'caption_save', 'caption', 'page_layout',
                'icon_image', 'order_num', 'visible', 'enabled',
                'min_rank',
            ]);
    }
}
