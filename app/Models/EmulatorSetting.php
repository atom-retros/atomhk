<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmulatorSetting extends Model
{
    protected $primaryKey = 'key';

    protected $guarded = [];

    public $timestamps = false;
}