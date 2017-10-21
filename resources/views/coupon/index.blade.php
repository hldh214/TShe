@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>
            我的礼券
        </h3>
        <div class="cards">
            @foreach($user->coupons as $coupon)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>名称: {{ $coupon->name }}</p>
                        <p>描述: {{ $coupon->description }}</p>
                        <p>&yen;{{ $coupon->amount }}</p>
                        <p>获得时间: {{ $coupon->pivot->created_at }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
