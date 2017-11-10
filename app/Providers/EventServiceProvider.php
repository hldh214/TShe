<?php

namespace App\Providers;

use App\Models\Coupon;
use App\Models\Order;
use App\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event'                              => [
            'App\Listeners\EventListener',
        ],
        'SocialiteProviders\Manager\SocialiteWasCalled' => [
            'SocialiteProviders\QQ\QqExtendSocialite@handle',
            'SocialiteProviders\WeixinWeb\WeixinWebExtendSocialite@handle',
            'SocialiteProviders\Weixin\WeixinExtendSocialite@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        User::created(function ($user) {
            $user->coupons()->save(Coupon::find(1));
        });

        Order::updated(function ($order) {
            if ($order->status == 1) {
                $user        = $order->user;
                $user->point += $order->amount * env('POINT_RATIO');
                $user->save();

                if (isset($order->coupon_id)) {
                    $user->coupons()->detach($order->coupon_id);
                }
            }
        });
    }
}
