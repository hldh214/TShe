<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Gift;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifts     = Gift::all();
        $addresses = Address::where('user_id', auth()->id())->get();

        return view('gift.index', compact('gifts', 'addresses'));
    }

    public function receive_gift(Request $request)
    {
        $gift_id = $request->post('gift_id');

        $user = User::find(auth()->id());
        $gift = Gift::find($gift_id);
        if ($gift->price > $user->point) {
            return response([
                'code' => 1,
                'data' => [
                    'msg' => '积分不足'
                ]
            ]);
        }

        $order             = new Order();
        $order->amount     = $gift->price;
        $order->item       = [
            'gift_id' => $gift_id
        ];
        $order->address_id = $request->post('address_id');
        $order->status     = 1;

        $user->point -= $gift->price;

        DB::transaction(function () use ($order, $user) {
            $order->save();
            $user->save();
        }, 3);

        return response([
            'code' => 0
        ]);
    }
}
