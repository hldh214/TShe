<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function store_avatar(Request $request)
    {
        $param_name = 'avatar';
        if ($request->file($param_name)->isValid()) {
            $this->validate($request, [
                $param_name => 'required|image',
            ]);

            $path = $request->$param_name->store($param_name, 'admin');

            $user         = User::find(auth()->id());
            $user->avatar = $path;
            $user->save();

            return response([
                'code' => 0
            ]);
        }

        return response([
            'code' => 1
        ]);
    }
}
