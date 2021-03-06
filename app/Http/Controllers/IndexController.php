<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\IndexImage;
use App\Models\Story;
use App\Models\Topic;

class IndexController extends Controller
{
    public function index()
    {
        $carousels   = Carousel::all();
        $indexImages = IndexImage::all();

        return view('index.index', compact('carousels', 'indexImages'));
    }

    public function stories()
    {
        $stories = Story::all();

        return view('index.stories', compact('stories'));
    }

    public function topics()
    {
        $topics = Topic::all();

        return view('index.topics', compact('topics'));
    }

    public function story($id)
    {
        $story = Story::find($id);

        return view('index.story', compact('story'));
    }

    public function topic($id)
    {
        $topic = Topic::find($id);

        return view('index.topic', compact('topic'));
    }
}
