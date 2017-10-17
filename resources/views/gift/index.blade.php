@extends('layouts.app')

@section('style')
    <style>
        .mb-0 {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h3><b>GIFTS</b> 礼品</h3>
        <p>您好，欢迎来到积分兑换商城！ 您有 {{ $user->point }} 积分</p>
        <div class="cards">
            @foreach($gifts as $gift)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="{{ $gift->image_uri }}" alt="image" class="img-responsive">
                        <div class="row">
                            <div class="col-xs-7">
                                <h4 class="mb-0">{{ $gift->name }}</h4>
                                <p class="mb-0">需要积分: {{ $gift->price }}</p>
                            </div>
                            <div class="col-xs-5">
                                <a class="btn btn-default btn-lg" href="x"
                                   role="button">立即领取</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
