<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private static function parse_cart($raw_row_ids)
    {
        $cart    = Cart::content();
        $row_ids = json_decode($raw_row_ids);

        return $cart->filter(function ($_, $rowId) use ($row_ids) {
            return in_array($rowId, $row_ids);
        });
    }

    public function create(Request $request)
    {
        $raw_row_ids = $request->post('row_ids');
        $data        = self::parse_cart($raw_row_ids);

        $addresses = Address::where('user_id', auth()->id())->get();

        return view('order.create', compact('data', 'addresses', 'raw_row_ids'));
    }

    public function store(Request $request)
    {
        $data         = self::parse_cart($request->post('row_ids'));
        $address_id   = $request->post('address_id');
        $comment      = $request->post('comment');
        $item         = $data->map(function ($item) {
            return [
                'item_id' => $item->id,
                'size'    => $item->options->size,
                'qty'     => $item->qty
            ];
        })->values();
        $amount       = $data->reduce(function ($carry, $item) {
            return $carry + $item->qty * $item->price;
        }, 0);
        $coupon       = null;
        $out_trade_no = microtime(true) * 10000 . rand(100000, 999999);

        $order               = new Order();
        $order->out_trade_no = $out_trade_no;
        $order->amount       = $amount;
        $order->comment      = $comment;
        $order->coupon       = $coupon;
        $order->item         = $item;
        $order->address_id   = $address_id;
        $order->user_id      = auth()->id();
        $order->save();

        app(CartController::class)->destroy(
            implode(',', json_decode($request->post('row_ids')))
        );

        return response([
            'code' => 0,
            'data' => [
                'id' => $order->id
            ]
        ]);
    }

    public function show($id)
    {
        $order = Order::find($id);

        return view('order.show', compact('order'));
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();

        return view('order.index', compact('orders'));
    }
}
