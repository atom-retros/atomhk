<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wordfilter extends Model
{
    protected $table = 'wordfilter';

    protected $guarded = [];

    protected $primaryKey = 'key';

    public $timestamps = false;

    public $incrementing = false;
}
