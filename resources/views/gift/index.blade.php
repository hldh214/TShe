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
                                <button class="btn btn-default btn-lg toggle-modal"
                                        data-id="{{ $gift->id }}">
                                    立即领取
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">请选择收货地址</h4>
                </div>
                <div class="modal-body">
                    <div class="cards">
                        @foreach($addresses as $address)
                            <div class="panel panel-default address" data-id="{{ $address->id }}">
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.bootcss.com/distpicker/2.0.1/distpicker.min.js"></script>
    <script src="/js/init_distpicker.js"></script>
    <script>
        $('.toggle-modal').on('click', function (event) {
            $('#myModal').modal({
                keyboard: false
            }).data('gift_id', $(event.target).data('id'));
        });

        $('.address').on('click', function (event) {
            $.ajax({
                url: '{{ route('receive_gift') }}',
                method: 'POST',
                data: {
                    'address_id': $(event.target).parents('.address').data('id'),
                    'gift_id': $('#myModal').data('gift_id')
                },
                success: function (res) {
                    if (res.code !== 0) {
                        alert(res.data.msg);
                        location.reload();
                        return false;
                    }
                    location.href = '{{ route('orders.index') }}';
                }
            });
        });
    </script>
@endsection
