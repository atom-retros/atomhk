<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CatalogPage extends Model
{
    use LogsActivity;

    protected $guarded = ['id'];

    public $timestamps = false;

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