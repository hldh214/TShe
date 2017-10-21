<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="theme-color" content="{{ env('THEME_COLOR') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .price {
            color: #ff5859;
            font-weight: 700;
        }

        .navbar {
            height: 44px;
        }

        body {
            background-color: #f4f7fa;
        }

        .gray {
            color: #909090;
        }
    </style>
    <title>Laravel</title>
</head>
<body>
<div class="my-container">
    <div class="sticky-top" style="background-color: white">
        <nav class="navbar navbar-light">
            <a class="navbar-brand" href="javascript:history.back()">
                <i class="fa fa-chevron-left" style="font-size: 12px; color: black;"></i>
            </a>
            <b><span>选择支付</span></b>
            <b></b>
        </nav>
    </div>
    <div class="card border-light">
        <div class="card-body text-dark">
            <p>订单已提交 订单号：{{ $order->out_trade_no }}</p>
            <hr>
            <div class="gray">
                <p class="mb-0">
                    <span>收货人:</span>
                    <span>{{ $order->address->name }}</span>
                    <span>{{ $order->address->phone }}</span>
                </p>
                <p class="mb-0">
                    <span>收货地址:</span>
                    <span class="province" data-no="{{ $order->address->province }}"></span>
                    <span class="city" data-no="{{ $order->address->city }}"></span>
                    <span class="district" data-no="{{ $order->address->district }}"></span>
                    <span>{{ $order->address->address }}</span>
                </p>
            </div>
        </div>
    </div>
    <div class="card border-light">
        <div class="card-body text-dark">
            <span>订单金额</span>
            <span class="pull-right price">
                @php ($amount = $order->amount)
                @if($user->coupons->where('id', $order->coupon_id)->isNotEmpty())
                @php ($amount -= $user->coupons->where('id', $order->coupon_id)->first()->amount)
                @endif
                &yen;{{ $amount }}
            </span>
        </div>
    </div>
    <div class="card border-light">
        <div class="card-body text-dark">
            <p class="gray">请选择支付方式</p>
            <hr>
            <a class="btn btn-block btn-outline-primary" href="">支付宝支付</a>
            <a class="btn btn-block btn-outline-success" href="">微信支付</a>
        </div>
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/distpicker/2.0.1/distpicker.min.js"></script>
<script src="/js/init_distpicker.js"></script>
<script>
    // initial
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
