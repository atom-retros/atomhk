<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity, TwoFactorAuthenticatable;

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function currencies(): HasMany
    {
        return $this->hasMany(UserCurrency::class, 'user_id');
    }

    public function currency(string $currency)
    {
        $type = match ($currency) {
            'duckets' => 0,
            'diamonds' => 5,
            'points' => 101,
        };

        return $this->currencies()->where('type', '=', $type)->first()->amount ?? 0;
    }

    public function permission(): HasOne
    {
        return $this->hasOne(Permission::class, 'id', 'rank');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(WebsiteArticle::class);
    }

    public function privateChatlogsSent(): HasMany
    {
        return $this->hasMany(ChatlogPrivate::class, 'user_from_id', 'id');
    }

    public function privateChatlogsReceived(): HasMany
    {
        return $this->hasMany(ChatlogPrivate::class, 'user_to_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'username', 'password', 'mail', 'motto', 'rank', 'hidden_staff', 'credits', 'ip_current',
            ]);
    }

    public function updateCurrency(string $currency, int $amount): void
    {
        $type = match ($currency) {
            'duckets' => 0,
            'diamonds' => 5,
            'points' => 101,
        };

        $currentCurrency = $this->currency($currency);
        $this->currencies()->where('type', '=', $type)->update(['amount' => $currentCurrency + $amount]);
    }
}
