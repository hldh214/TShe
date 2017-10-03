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
                    <p>{{ $user->name }}</p>
                </div>
                <div class="col-xs-4">
                    <a href="{{ route('address.index') }}">管理收货地址</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    Basic panel example
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    Basic panel example
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    Basic panel example
                </div>
            </div>

        </div>
    </div>
@endsection
