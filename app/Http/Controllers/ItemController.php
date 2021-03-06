<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Item;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Style;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
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
        $items = Item::where('user_id', auth()->id())->get();

        return view('item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $material_types = MaterialType::all();
        $words          = Word::all();
        $categories     = Category::all();
        $styles         = Style::all()->makeHidden('item_detail');
        $colors         = Color::all();
        $materials = Material::all();

        return view('item.create', compact('material_types', 'words', 'categories', 'styles', 'colors', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filename = date('YmdHis') . '-' . uniqid();
        $front    = "items/{$filename}-front.png";
        $back     = "items/{$filename}-back.png";
        Storage::disk('admin')->put($front, base64_decode(explode(',',
            $request->input('front'))
        [1]));
        Storage::disk('admin')->put($back, base64_decode(explode(',',
            $request->input('back'))
        [1]));

        $item              = new Item();
        $item->category_id = $request->input('category_id');
        $item->style_id    = $request->input('style_id');
        $item->color_id    = $request->input('color_id');
        $item->user_id     = auth()->id();
        $item->front       = $front;
        $item->back        = $back;
        $item->save();


        return response([
            'code' => 0,
            'data' => [
                'id' => $item->id
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
        $item       = Item::find($id);
        $cart_count = Cart::instance('default')->count();

        return view('item.show', compact('item', 'cart_count'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
