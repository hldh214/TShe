<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $row_ids = json_decode($request->post('row_ids'));
        $cart = Cart::content();
        $data = $cart->filter(function ($_, $rowId) use ($row_ids) {
            return in_array($rowId, $row_ids);
        });

        $addresses = Address::where('user_id', auth()->id())->get();

        return view('order.create', compact('data', 'addresses'));
    }
}
