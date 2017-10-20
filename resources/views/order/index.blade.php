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
            left: 50%;
            transform: translate(-50%, -50%) scale(0.04);
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h3>
            我的订单
        </h3>
        <div class="cards">
            @foreach($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>
                            <span>{{ $order->created_at }}</span>
                            <span class="pull-right" @if($order->status == 0)style="color: #ff5a41;"@endif>{{
                            $order->get_order_status()
                            }}</span>
                        </p>
                        @if($order->get_gift_or_fail())
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="img-container">
                                        <img class="bottom"
                                             src="{{ $order->get_gift_or_fail()['gift']->image_uri }}"
                                             alt="style->front">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <p>
                                        {{ $order->get_gift_or_fail()['gift']->name }}
                                        <span class="pull-right">x1</span>
                                    </p>
                                </div>
                                <div class="col-xs-3">
                                    <p>
                                        <span>{{ $order->get_gift_or_fail()['gift']->price }}</span>
                                    </p>
                                </div>
                            </div>
                        @else
                            @foreach($order->get_order_items() as $item_and_size)
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="img-container">
                                            <img class="top" src="{{ $item_and_size['item']->front_uri }}" alt="front">
                                            <img style="background-color: {{ $item_and_size['item']->color->value }};"
                                                 class="bottom"
                                                 src="{{ $item_and_size['item']->style->front_uri }}"
                                                 alt="style->front">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <p>
                                            {{ $item_and_size['item']->user->name }}
                                            的{{ $item_and_size['item']->getBuyableDescription() }}
                                            {{ $item_and_size['size'] }}
                                            <span class="pull-right">x{{ $item_and_size['qty'] }}</span>
                                        </p>
                                    </div>
                                    <div class="col-xs-3">
                                        <p>
                                            <span>&yen;{{ $item_and_size['item']->style->price }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row">
                                <div class="col-xs-4 col-xs-offset-8">
                                    <span>总金额{{ $order->amount }}</span>
                                </div>
                            </div>
                            @if($order->status == 0)
                                <div class="row">
                                    <div class="col-xs-4 col-xs-offset-8">
                                        <a href="{{ route('orders.show', $order->id) }}"
                                           class="btn btn-danger btn-sm"
                                           style="background-color: #ff5a5e;">立即支付</a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')

@endsection