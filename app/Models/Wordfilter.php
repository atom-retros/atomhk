<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Wordfilter extends Model
{
    protected $table = 'wordfilter';

    protected $guarded = [];

    protected $primaryKey = 'key';

    public $timestamps = false;

    public $incrementing = false;
}
