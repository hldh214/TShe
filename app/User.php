<?php

namespace App;

use App\Models\Address;
use App\Models\Coupon;
use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    protected $appends = ['avatar_uri'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const type = [
        0 => '注册',
        1 => 'qq',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function getAvatarUriAttribute()
    {
        if ($this->type === 0) {
            return Storage::disk('admin')->url($this->avatar);
        }

        return $this->avatar;
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class)->withTimestamps();
    }
}
