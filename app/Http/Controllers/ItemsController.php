<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Item;
use App\Models\MaterialType;
use App\Models\Style;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $styles         = Style::all();
        $colors         = Color::all();

        return view('items.create', compact('material_types', 'words', 'categories', 'styles', 'colors'));
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
        $item = Item::find($id);
        return view('items.show', compact('item'));
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
