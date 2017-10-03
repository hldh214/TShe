@extends('layouts.app')

@section('style')
    <style>
        .img-container {
            position: relative;
        }

        .img-container .bottom {
            width: 100%;
        }

        .img-container .top {
            position: absolute;
            z-index: 1;
            top: 60%;
            left: 49%;
            transform: translate(-50%, -50%) scale(0.12);
        }

        .card {
            border-radius: 2px;
            border: 1px solid #f0f0f0;
            margin-top: 20px;
        }

        .check-detail {
            font-size: 12px;
            color: #4a4a4a;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h3>我的设计</h3>
        <div class="cards">
            @foreach($items->chunk(2) as $chunks)
                <div class="row">
                    @foreach($chunks as $chunk)
                        <div class="col-xs-6">
                            <div class="card">
                                <a href="{{ route('items.show', $chunk->id) }}">
                                    <div class="img-container">
                                        <img class="top" data-src="{{ $chunk->front_uri }}" alt="front"
                                             src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                                        <img style="background-color: {{ $chunk->color->value }};" class="bottom"
                                             data-src="{{ $chunk->style->front_uri }}" alt="style->front"
                                             src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                                    </div>
                                    <p class="pull-right check-detail">
                                        查看详情
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.bootcss.com/jquery.lazyloadxt/1.1.0/jquery.lazyloadxt.min.js"></script>
@endsection
