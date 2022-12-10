<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteStaffApplicationStatus extends Model
{
    protected $guarded = ['id'];

    public function application(): BelongsTo
    {
        return $this->belongsTo(WebsiteStaffApplication::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}