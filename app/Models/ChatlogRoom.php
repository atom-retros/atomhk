<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatlogRoom extends Model
{
    protected $table = 'chatlogs_room';

    protected $guarded = ['id'];

    public $timestamps = false;
    protected $primaryKey = 'false';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_from_id', 'id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}