@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('address.update', $address->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">收货人姓名:</label>
                <input type="text" class="form-control" name="name"
                       id="name" placeholder="收件人" value="{{ $address->name }}">
            </div>
            <div data-toggle="distpicker" data-value-type="code" data-autoselect="3" class="form-group">
                <label>收货人地址:</label>
                <select class="form-control" name="province" data-province="{{ $address->province }}"></select>
                <select class="form-control" name="city" data-city="{{ $address->city }}"></select>
                <select class="form-control" name="district" data-district="{{ $address->district }}"></select>
            </div>
            <div class="form-group">
                <label for="address">详细地址:</label>
                <textarea class="form-control" id="address" name="address" placeholder="请输入详细地址">{{ $address->address }}</textarea>
            </div>
            <div class="form-group">
                <label for="phone">联系电话:</label>
                <input type="number" class="form-control" name="phone"
                       id="phone" placeholder="联系电话" value="{{ $address->phone }}">
            </div>
            <button type="submit" class="btn btn-default btn-lg btn-block">保存信息</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://cdn.bootcss.com/distpicker/2.0.1/distpicker.min.js"></script>
@endsection
