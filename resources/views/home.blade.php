@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="cards">
            <div class="row">
                <div class="col-xs-4">
                    <div class="thumbnail">
                        <img
                            src="@if(Storage::disk('admin')->exists($user->avatar)){{ $user->avatar_uri }}@else@verbatim/img/picture.png@endverbatim@endif"
                            alt="avatar" id="avatar">
                        <input style="display: none" type="file" id="file-upload" name="avatar" data-url="{{ route
                        ('store_avatar') }}" accept="image/*">
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
                    <span>我的积分: {{ $user->point }}</span>
                    <a class="pull-right" href="{{ route('gifts.index') }}">兑换</a>
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
                    <a href="{{ route('coupons.index') }}">我的礼券</a>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.bootcss.com/blueimp-file-upload/9.19.1/js/vendor/jquery.ui.widget.min.js"></script>
    <script src="https://cdn.bootcss.com/blueimp-file-upload/9.19.1/js/jquery.fileupload.min.js"></script>
    <script>
        $('#avatar').on('click', function () {
            $('#file-upload').click();
        });

        $('#file-upload').fileupload({
            done: function () {
                location.reload();
            },
            error: function () {
                location.reload();
            }
        });
    </script>
@endsection
