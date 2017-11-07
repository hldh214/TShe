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
        if (Pay::driver('alipay')->gateway()->verify($request->all())) {
            $order = Order::where('out_trade_no', $request->out_trade_no)->first();
            $order->status = 1;
            $order->save();
        }

        echo "success";
    }
}
