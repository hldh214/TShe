@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{ $topic->cover_uri }}" alt="cover" class="img-responsive">
                <h4>{{ $topic->title }}</h4>
                <small>{{ $topic->created_at->toDateString() }}</small>
            </div>
            <div class="panel-body">
                <div class="images">
                    @foreach($topic->images_uri as $image)
                        <img src="{{ $image }}" alt="images" class="img-responsive">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
