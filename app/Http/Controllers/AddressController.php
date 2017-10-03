<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use function Sodium\add;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->get();

        return view('address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address           = new Address();
        $address->user_id  = auth()->id();
        $address->province = $request->post('province');
        $address->city     = $request->post('city');
        $address->district = $request->post('district');
        $address->address  = $request->post('address');
        $address->phone    = $request->post('phone');
        $address->name     = $request->post('name');
        $address->save();

        return redirect()->route('address.index');
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
        $address = Address::find($id);

        return view('address.edit', compact('address'));
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
        $address           = Address::find($id);
        $address->province = $request->post('province');
        $address->city     = $request->post('city');
        $address->district = $request->post('district');
        $address->address  = $request->post('address');
        $address->phone    = $request->post('phone');
        $address->name     = $request->post('name');
        $address->save();

        return redirect()->route('address.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Address::find($id)->delete();

        return response([
            'code' => 0,
            'data' => []
        ]);
    }
}
