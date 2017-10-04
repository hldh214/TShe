@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="cards">
            <div class="row">
                <div class="col-xs-4">
                    <div class="thumbnail">
                        <img src="{{ $user->avatar_uri }}" alt="avatar">
                    </div>
                </div>
                <div class="col-xs-4">
                    <h3>{{ $user->name }}</h3>
                    <p>会员</p>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-default btn-sm" href="{{ route('addresses.index') }}">管理收货地址</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="{{ route('orders.index') }}">我的订单</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="{{ route('items.index') }}">我的设计</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="">我的礼券</a>
                </div>
            </div>

        </div>
    </div>
@endsection
