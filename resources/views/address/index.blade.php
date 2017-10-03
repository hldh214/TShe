@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>
            我的地址
            <small class="pull-right">
                <a href="{{ route('address.create') }}">
                    <span class="glyphicon glyphicon-plus"></span>
                    新增地址
                </a>
            </small>
        </h3>
        <div class="cards">
            @foreach($addresses as $address)
                <div class="panel panel-default" id="address-{{ $address->id }}">
                    <div class="panel-body">
                        <p>
                            <span>{{ $address->name }}</span>
                            <span>{{ $address->phone }}</span>
                        </p>
                        <p>
                            <span class="province" data-no="{{ $address->province }}"></span>
                            <span class="city" data-no="{{ $address->city }}"></span>
                            <span class="district" data-no="{{ $address->district }}"></span>
                        </p>
                        <p>{{ $address->address }}</p>
                        <a class="btn btn-default" href="{{ route('address.edit', $address->id) }}"
                           role="button">修改</a>
                        <a class="btn btn-danger destroy" data-id="{{ $address->id }}"
                           role="button">删除</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.bootcss.com/distpicker/2.0.1/distpicker.min.js"></script>
    <script>
        // logic
        $('.province').each(function (_, value) {
            let province_no = $(value).data('no');
            $(value).text($(document).distpicker('getDistricts')[province_no]);
        });

        $('.city').each(function (_, value) {
            let city_no = $(value).data('no');
            $(value).text($(document).distpicker('getDistricts', $(value).prev().data('no'))[city_no]);
        });

        $('.district').each(function (_, value) {
            let district_no = $(value).data('no');
            $(value).text($(document).distpicker('getDistricts', $(value).prev().data('no'))[district_no]);
        });

        // event
        $('.destroy').on('click', function (event) {
            let id = $(event.target).data('id');
            $.ajax({
                url: '{{ route('address.index') }}' + '/' + id,
                method: 'DELETE'
            });
            $('#address-' + id).remove();
        });
    </script>
@endsection