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

        .buy-button {
            height: 50px;
            width: 100%;
            font-size: 14px;
            padding: 0;
            background-color: white;
        }

        .submit {
            border: 0;
            padding: 0;
            height: 100%;
            width: 30%;
            color: #FFF;
        }

        .red {
            background-color: #ff5859;
        }

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
            transform: translate(-50%, -50%) scale(0.06);
        }

        body {
            background-color: #f4f7fa;
        }

        .addresses {
            background-color: white;
            margin: 10px 0;
            padding: 0 5px;
        }

        .colorful-bar {
            width: 100%;
            height: 4px;
            background: repeating-linear-gradient(-45deg, #ff5859, #ff5859 20%, transparent 0, transparent 25%, #ffd423 0, #ffd423 45%, transparent 0, transparent 50%) 24px/108px 108px;
        }
    </style>
    <title>Laravel</title>
</head>
@inject('style', 'App\Models\Style')
<body>
<div class="my-container">
    <div class="sticky-top" style="background-color: white">
        <nav class="navbar navbar-light">
            <a class="navbar-brand" href="javascript:history.back()">
                <i class="fa fa-chevron-left" style="font-size: 12px; color: black;"></i>
            </a>
            <b><span>确认订单</span></b>
            <b></b>
        </nav>
    </div>
    <div class="addresses">
        @foreach($addresses as $address)
            <label class="custom-control custom-radio">
                <input name="address" value="{{ $address->id }}"
                       type="radio" class="custom-control-input"
                       @if ($loop->first) checked @endif>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">
                    <span>{{ $address->name }}</span>
                    <span>{{ $address->phone }}</span>
                    <span class="province" data-no="{{ $address->province }}"></span>
                    <span class="city" data-no="{{ $address->city }}"></span>
                    <span class="district" data-no="{{ $address->district }}"></span>
                    <span>{{ $address->address }}</span>
                    <a href="{{ route('addresses.edit', $address->id) }}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </span>
            </label>
            @if ($loop->last)
                <div class="colorful-bar"></div>
            @endif
        @endforeach
    </div>
    <div class="cards">
        @foreach($data as $datum)
            <div class="card border-light">
                <div class="card-body text-dark">
                    <div class="row">
                        <div class="col-4">
                            <div class="img-container">
                                <img class="top" src="{{ $datum->model->front_uri }}" alt="front">
                                <img style="background-color: {{ $datum->model->color->value }};" class="bottom"
                                     src="{{ $datum->model->style->front_uri }}" alt="style->front">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="info">
                                <p class="mb-0">
                                    {{ $datum->model->user->name }}的{{ $datum->name }}
                                    {{ $style::sizes[$datum->options->size] }}
                                </p>
                                <small style="color: #c5c5c5;">承诺3个工作日内发货</small>
                                <p class="mb-0">
                                    <span class="price each-price"
                                          data-price="{{ $datum->price }}"
                                          data-qty="{{ $datum->qty }}"
                                    >&yen;{{ $datum->price }}</span>
                                    <small class="text-muted pull-right">
                                        x{{ $datum->qty }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="card border-light">
            <div class="card-body text-dark">
                <span>运送方式</span>
                <span class="pull-right">快递 免费</span>
            </div>
        </div>
        <div class="card border-light">
            <div class="card-body text-dark">
                <label for="coupon">使用礼券</label>
                <select class="pull-right" name="coupon" id="coupon">
                    @foreach($user->coupons as $coupon)
                        <option value="{{ $coupon->id }}" data-amount="{{ $coupon->amount }}">
                            {{ $coupon->name }}
                        </option>
                    @endforeach
                        <option value="" data-amount="0">无</option>
                </select>
            </div>
        </div>
        <div class="card border-light">
            <div class="card-body text-dark">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="comment" class="ml-0">买家留言:</label>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control form-control-sm" id="comment"
                                   placeholder="特殊要求请留言">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5"></div>
    <nav class="navbar fixed-bottom  buy-button">
        <label class="custom-control custom-checkbox mb-0 ml-2"></label>
        <span>合计: <span class="price">&yen; <span id="subtotal"></span></span></span>
        <input class="submit red" id="submit-button" type="button" value="结算">
    </nav>
</div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/distpicker/2.0.1/distpicker.min.js"></script>
<script src="/js/init_distpicker.js"></script>
<script>
    // logic
    let subtotal = 0;

    $('.each-price')
        .each(function (_, value) {
            let price = $(value).data('price');
            let qty = $(value).data('qty');
            subtotal += price * qty;
        })
        .promise()
        .done(function () {
            $('#subtotal').text(subtotal - $('#coupon option:selected').data('amount'));
        });

    $('#coupon').on('change', function () {
        let amount = $('#coupon option:selected').data('amount');
        $('#subtotal').text(subtotal - amount);
    });

    $('#submit-button').on('click', function () {
        let address_id = $('input[name=address]:checked').val();
        let row_ids = '{!! $raw_row_ids !!}';
        let comment = $('#comment').val();
        let coupon = $('#coupon').val();

        $.ajax({
            url: '{{ route('orders.store') }}',
            method: 'POST',
            data: {
                @if($buy_flag)
                'buy_flag': true,
                @endif
                'address_id': address_id,
                'row_ids': row_ids,
                'comment': comment,
                'coupon': coupon
            },
            success: function (res) {
                location.href = '{{ route('orders.store') }}' + '/' + res.data.id;
            }
        });
    });

    // initial
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
