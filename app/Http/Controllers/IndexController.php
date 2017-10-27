<?php

namespace App\Http\Controllers;

use App\Models\Carousel;

class IndexController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();

        return view('index.index', compact('carousels'));
    }

    public function guide()
    {
        return view('index.guide');
    }

    public function stories()
    {

    }

    public function topics()
    {

    }
}
