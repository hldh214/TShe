@extends('layouts.app')

@section('style')
    <style>
        .avatar {
            width: 32px;
            height: 32px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{ $story->avatar_uri }}" alt="avatar" class="avatar img-circle">
                {{ $story->title }}
            </div>
            <div class="panel-body">
                <div class="images">
                    @foreach($story->images_uri as $image)
                        <img src="{{ $image }}" alt="images" class="img-responsive">
                    @endforeach
                </div>
                <div class="contents">
                    {{ $story->content }}
                </div>
            </div>
        </div>
    </div>
@endsection
