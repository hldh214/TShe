@extends('layouts.app')

@section('style')
    <link href="https://cdn.bootcss.com/Swiper/3.4.2/css/swiper.min.css" rel="stylesheet">
    <style>
        .navbar {
            margin-bottom: 0;
        }

        .swiper-container {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($carousels as $carousel)
                <div class="swiper-slide">
                    <a href="{{ $carousel->link }}">
                        <img class="img-responsive" src="{{ $carousel->full_uri }}" lt="slide">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="container">
        @foreach($indexImages as $indexImage)
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="{{ $indexImage->link }}">
                        <img class="img-responsive" src="{{ $indexImage->full_uri }}" alt="morons">
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script src="https://cdn.bootcss.com/Swiper/3.4.2/js/swiper.jquery.min.js"></script>

    <script>
        // slider
        new Swiper('.swiper-container', {
            loop: true,
            pagination: '.swiper-pagination',
            paginationClickable: true,
            autoplay: 5000
        });
    </script>
@endsection
