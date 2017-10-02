<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('ShoppingCart');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        Cart::destroy();Cart::restore(auth()->id());exit;

        $contents = Cart::content();
        $subtotal = Cart::subtotal();

        return view('cart.index', compact('contents', 'subtotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::restore(auth()->id());

        Cart::add(
            Item::find($request->input('item_id')),
            $request->input('quantity'),
            ['size' => $request->input('size')]
        );

        Cart::store(auth()->id());

        return response([
            'code' => 0,
            'data' => [
                'count' => Cart::count()
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::restore(auth()->id());
        $type = $request->post('type');
        if ($type == 'qty') {
            Cart::update($id, $request->post('qty'));
        } elseif ($type == 'size') {
            Cart::update($id, ['options' => ['size' => $request->post('size')]]);
        }
        Cart::store(auth()->id());

        return response([
            'code' => 0,
            'data' => [
                'subtotal' => Cart::subtotal()
            ]
        ]);
    }

    /**
     * Remove resource(s) from storage.
     *
     * @param  int $ids
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        Cart::restore(auth()->id());
        $ids = explode(',', $ids);
        foreach ($ids as $id) {
            Cart::remove($id);
        }
        Cart::store(auth()->id());

        return response([
            'code' => 0,
            'data' => [
                'subtotal' => Cart::subtotal()
            ]
        ]);
    }
}
