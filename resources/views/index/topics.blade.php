@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($topics as $topic)
            <a href="{{ route('topic', ['id' => $topic->id]) }}">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="{{ $topic->cover_uri }}" alt="over" class="img-responsive">
                        <h4>{{ $topic->title }}</h4>
                        <small>{{ $topic->created_at->toDateString() }}</small>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
