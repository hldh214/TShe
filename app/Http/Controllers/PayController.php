<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yansongda\LaravelPay\Facades\Pay;

class PayController extends Controller
{
    public function alipay(Request $request, $out_trade_no, $total_amount, $subject)
    {
        return Pay::driver('alipay')
            ->gateway('wap')
            ->pay(compact('out_trade_no', 'total_amount', 'subject'));
    }

    public function alipay_return(Request $request)
    {
//        return Pay::driver('alipay')->gateway()->verify($request->all());
        return redirect()->route('orders.index');
    }

    public function alipay_notify(Request $request)
    {
        // todo: gateway == wap?
        if (Pay::driver('alipay')->gateway()->verify($request->all())) {
            $order         = Order::where('out_trade_no', $request->out_trade_no)->first();
            $order->status = 1;
            $order->save();
        }

        echo "success";
    }

    public function wxpay(Request $request)
    {
        $openid    = session('openid');
        $out_trade_no = $request->get('out_trade_no');
        $total_fee = $request->get('total_fee') * 100;
        $body = $request->get('body');
        if (is_null($openid)) {
            return redirect()->route('oauth', ['service' => 'weixin']);
        }

        return view(
            'pay.wxpay',
            ['pay' => Pay::driver('wechat')->gateway('mp')->pay(compact('out_trade_no', 'total_fee', 'body', 'openid'))]
        );
    }

    public function wxpay_notify(Request $request)
    {
        if (Pay::driver('wechat')->gateway('mp')->verify($request->all())) {
            $order         = Order::where('out_trade_no', $request->out_trade_no)->first();
            $order->status = 1;
            $order->save();
        }

        echo "success";
    }
}
