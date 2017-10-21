<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\Item;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private static function parse_cart($raw_row_ids)
    {
        $row_ids = json_decode($raw_row_ids);

        $cart_things     = Cart::instance('default')->content()->filter(function ($_, $rowId) use ($row_ids) {
            return in_array($rowId, $row_ids);
        });
        $buy_flag_things = Cart::instance('buy_flag')->content()->filter(function ($_, $rowId) use ($row_ids) {
            return in_array($rowId, $row_ids);
        });

        return $cart_things->isEmpty() ? $buy_flag_things : $cart_things;
    }

    public function create(Request $request)
    {
        $buy_flag = $request->has('buy_flag');
        if ($buy_flag) {
            Cart::instance('buy_flag')->destroy();
            $item        = Item::find($request->post('item_id'));
            $data        = [Cart::instance('buy_flag')->add($item, $request->post('quantity'), [
                'size' => $request->post('size')
            ])];
            $raw_row_ids = json_encode([$data[0]->rowId]);
        } else {
            $raw_row_ids = $request->post('row_ids');
            $data        = self::parse_cart($raw_row_ids);
        }

        $addresses = Address::where('user_id', auth()->id())->get();

        return view('order.create', compact('data', 'addresses', 'raw_row_ids', 'buy_flag'));
    }

    public function store(Request $request)
    {
        $data       = self::parse_cart($request->post('row_ids'));
        $address_id = $request->post('address_id');
        $comment    = $request->post('comment');
        $item       = $data->map(function ($item) {
            return [
                'item_id' => $item->id,
                'size'    => $item->options->size,
                'qty'     => $item->qty
            ];
        })->values();
        $amount     = $data->reduce(function ($carry, $item) {
            return $carry + $item->qty * $item->price;
        }, 0);
        $coupon_id  = $request->post('coupon');

        $order = new Order();
        if (!empty($coupon_id)) {
//            $amount           -= Coupon::find($coupon_id)->amount;
            $order->coupon_id = $coupon_id;
        }

        $order->amount     = $amount;
        $order->comment    = $comment;
        $order->item       = $item;
        $order->address_id = $address_id;
        $order->save();

        if ($request->has('buy_flag')) {
            app(CartController::class)->destroy(
                implode(',', json_decode($request->post('row_ids'))),
                CartController::BUY_FLAG
            );
        } else {
            app(CartController::class)->destroy(
                implode(',', json_decode($request->post('row_ids')))
            );
        }

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
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('order.index', compact('orders'));
    }
}
