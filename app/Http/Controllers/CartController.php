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
        $contents = Cart::instance('default')->content();
        $subtotal = Cart::instance('default')->subtotal(0);

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
        Cart::instance('default')->restore(auth()->id());

        Cart::instance('default')->add(
            Item::find($request->input('item_id')),
            $request->input('quantity'),
            ['size' => $request->input('size')]
        );

        Cart::instance('default')->store(auth()->id());

        return response([
            'code' => 0,
            'data' => [
                'count' => Cart::instance('default')->count()
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
        Cart::instance('default')->restore(auth()->id());
        $type = $request->post('type');
        if ($type == 'qty') {
            Cart::instance('default')->update($id, $request->post('qty'));
        } elseif ($type == 'size') {
            Cart::instance('default')->update($id, ['options' => ['size' => $request->post('size')]]);
        }
        Cart::instance('default')->store(auth()->id());

        return response([
            'code' => 0,
            'data' => [
                'subtotal' => Cart::instance('default')->subtotal(0)
            ]
        ]);
    }

    /**
     * Remove resource(s) from storage.
     *
     * @param  string $ids (csv)
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        Cart::instance('default')->restore(auth()->id());
        $ids = explode(',', $ids);
        foreach ($ids as $id) {
            Cart::instance('default')->remove($id);
        }
        Cart::instance('default')->store(auth()->id());

        return response([
            'code' => 0,
            'data' => [
                'subtotal' => Cart::instance('default')->subtotal(0)
            ]
        ]);
    }
}
