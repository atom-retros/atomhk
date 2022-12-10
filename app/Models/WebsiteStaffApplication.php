<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WebsiteStaffApplication extends Model
{
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'rank_id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(WebsiteStaffApplicationStatus::class, 'application_id');
    }
}