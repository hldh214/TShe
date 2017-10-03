@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('address.store') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="name">收货人姓名:</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="收件人">
            </div>
            <div data-toggle="distpicker" data-value-type="code" data-autoselect="3" class="form-group">
                <label>收货人地址:</label>
                <select class="form-control" name="province"></select>
                <select class="form-control" name="city"></select>
                <select class="form-control" name="district"></select>
            </div>
            <div class="form-group">
                <label for="address">详细地址:</label>
                <textarea class="form-control" id="address" name="address" placeholder="请输入详细地址"></textarea>
            </div>
            <div class="form-group">
                <label for="phone">联系电话:</label>
                <input type="number" class="form-control" name="phone" id="phone" placeholder="联系电话">
            </div>
            <button type="submit" class="btn btn-default btn-lg btn-block">保存信息</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://cdn.bootcss.com/distpicker/2.0.1/distpicker.min.js"></script>
@endsection
