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
    <link href="https://cdn.bootcss.com/Swiper/3.4.2/css/swiper.min.css" rel="stylesheet">
    <style>
        body {
            text-align: center;
        }

        p {
            margin-bottom: 0;
        }

        h5 {
            margin: 20px 0;
        }

        .buy-button {
            box-shadow: 0 -2px 10px hsla(0, 0%, 9%, .12);
            height: 50px;
            width: 100%;
            font-size: 14px;
            padding: 0;
        }

        .buy-button > [type=button] {
            border: 0;
            padding: 0;
            height: 100%;
            width: 40%;
        }

        .shopping-cart {
            color: gray;
            width: 20%;
            background-color: white;
            height: 100%;
        }

        .add-to-cart {
            color: #ff5859;
            background-color: #ffecec;
        }

        .buy-immediately {
            color: #FFF;
            background-color: #ff696a;
        }

        .swiper-container {
            height: 280px;
        }

        .img-container {
            position: relative;
        }

        .img-container .bottom {
            width: 70%;
        }

        .img-container .top {
            position: absolute;
            z-index: 1;
            top: 58%;
            left: 49.5%;
            transform: translate(-50%, -50%) scale(0.2);
        }

        .info {
            text-align: left;
        }

        .user-info {
            position: relative;
            z-index: 2;
        }

        .user-info img {
            position: absolute;
            width: 50px;
            height: 50px;
            left: 0;
            bottom: 2px;
            background-color: #fff;
            border: 3px solid #fff;
            border-radius: 50%;
        }

        .username {
            color: gray;
            padding-left: 60px;
        }

        .title-content {
            font-size: 16px;
            font-weight: 700;
            color: #161616;
            white-space: nowrap;
            text-overflow: ellipsis;
            display: block;
            overflow: hidden;
        }

        .price {
            margin: 15px 0;
        }

        .price-red {
            color: #ff5859;
            font-weight: 700;
        }

        .price-content {
            font-size: 20px;
        }

        .select-modal-trigger {
            text-align: left;
        }

        .margin-bottom {
            margin-bottom: 60px;
        }

        .detail-header {
            color: #161616;
            font-weight: 400;
            text-decoration: none;
            margin-top: 20px;
        }

        #submit {
            background-color: #ff5859;
            color: white;
        }
    </style>
    <title>Laravel</title>
</head>
<body>
<div class="slider">
    <div class="swiper-container" style="background-color: #f4f7fa;">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="img-container">
                    <img class="top" src="{{ $item->front_uri }}" alt="front">
                    <img style="background-color: {{ $item->color->value }};" class="bottom"
                         src="{{ $item->style->front_uri }}" alt="style->front">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="img-container">
                    <img class="top" src="{{ $item->back_uri }}" alt="back">
                    <img style="background-color: {{ $item->color->value }};" class="bottom"
                         src="{{ $item->style->back_uri }}" alt="style->back">
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<div class="container-fluid">
    <div class="info">
        <div class="user-info">
            <img src="/img/picture.png" alt="avatar">
            <small class="username">{{ auth()->user()->name }}</small>
        </div>
        <div class="title">
            <p class="title-content">{{ auth()->user()->name }}的{{ $item->style->name }}{{ $item->category->name }}</p>
        </div>
        <div class="price">
            <div class="price-red">
                <i class="fa fa-jpy" aria-hidden="true"></i>
                <span class="price-content">{{ $item->style->price }}</span>
            </div>
            <small style="color: gray;">快递: 免费</small>
        </div>
    </div>
    <div class="select-modal-trigger">
        <button class="btn btn-outline-dark btn-block add-to-cart-cmd" data-target="#select-modal" data-toggle="modal">
            选择 款式 颜色 尺码
        </button>
    </div>
    <div class="detail">
        <div class="detail-header">
            <div class="row">
                <div class="col-6">
                    <a href="#intro" class="btn btn-outline-warning btn-block">产品详情</a>
                </div>
                <div class="col-6">
                    <a href="#notice" class="btn btn-outline-warning btn-block">购买须知</a>
                </div>
            </div>
        </div>
        <div class="detail-content">
            <a name="intro"></a>
            <div class="content-intro">
                <h5>产品详情</h5>
                <img src="/img/detail1.jpg" alt="d1" class="img-fluid">
                <img src="/img/detail2.jpg" alt="d2" class="img-fluid">
                <img src="/img/detail3.jpg" alt="d3" class="img-fluid">
            </div>
            <a name="notice"></a>
            <div class="content-notice">
                <h5>买家须知</h5>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">色差说明</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Color</h6>
                        <p class="card-text">
                            由于印制使用的色彩模式CMYK不同于显示器色彩RGB，且受图片质量等因素影响，可能无法100%还原显示器上的图片效果。此属于正常误差范围。
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">发货时间</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Time</h6>
                        <p class="card-text">
                            统一在订购成功后的3个工作日内发货，订购成功起的次日算第一个工作日(周末以及节假日除外)。
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">快递说明</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Express</h6>
                        <p class="card-text">
                            发货物流为百世快递(大陆地区)，不同品类运费起步价不同，购买多件商品根据商品实际重量加收续重费用；港澳台地区运费起步价为30元；具体费用以结算金额为准。
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">退换货说明</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Returns</h6>
                        <p class="card-text">
                            定制类产品非质量问题(如对提前确认过的造型、印花图案不满意)不支持退换货。如因质量问题(如开线、破损等质量问题)，T社支持换货但是不予以退款。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="margin-bottom"></div>
    <nav class="navbar fixed-bottom  buy-button">
        <a href="{{ route('cart.index') }}" class="shopping-cart">
            <div class="icon-wrapper">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="badge badge-light">0</span>
            </div>
            <p>购物车</p>
        </a>
        <input class="add-to-cart add-to-cart-cmd" type="button" value="加入购物车" data-target="#select-modal"
               data-toggle="modal">
        <input class="buy-immediately" type="button" value="立即购买" data-target="#select-modal"
               data-toggle="modal">
    </nav>
</div>
<div class="modal fade" id="select-modal" style="text-align: left;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="img-container" style="zoom: 0.1; float: left">
                        <img style="background-color: {{ $item->color->value }};" class="bottom"
                             src="{{ $item->style->front_uri }}" alt="style->front">
                    </div>
                    <div class="price" style="float: left">
                        <div class="price-red">
                            <i class="fa fa-jpy" aria-hidden="true"></i>
                            <span class="price-content" id="modal-price">{{ $item->style->price }}</span>
                        </div>
                        <small style="color: gray;">快递: 免费</small>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="sizes">
                    <p>尺码</p>
                    <div class="btn-group" data-toggle="buttons">
                        @foreach($item->style->parse_size() as $size)
                            <label class="btn btn-outline-dark btn-sm size" data-size-id="{{ $loop->index }}">
                                <input type="radio">{{ $size }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="quantity">
                    <label for="quantity">数量</label>
                    <div class="input-group" style="width: 40%">
                        <span class="input-group-btn">
                            <button class="btn btn-outline-secondary" type="button" id="minus">-</button>
                        </span>
                        <input type="number" min="1" class="form-control" id="quantity" value="1">
                        <span class="input-group-btn">
                            <button class="btn btn-outline-secondary" type="button" id="plus">+</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit" class="btn btn-block">
                    确定
                </button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/Swiper/3.4.2/js/swiper.jquery.min.js"></script>
<script>
    // data assign
    let price = parseInt('{{ $item->style->price }}');

    // slider
    new Swiper('.swiper-container', {
        loop: true,
        pagination: '.swiper-pagination',
        paginationClickable: true,
    });

    // events
    $('#plus').on('click', function () {
        let res = parseInt($('#quantity').val()) + 1;
        $('#quantity').val(res).trigger('input');
    });

    $('#minus').on('click', function () {
        let res = parseInt($('#quantity').val()) - 1;
        res = res < 1 ? 1 : res;
        $('#quantity').val(res).trigger('input');
    });

    $('#quantity').on('input', function (event) {
        if (!event.target.value) {
            $('#quantity').val(1);
        }
        $('#modal-price').text(price * parseInt($('#quantity').val()));
    });

    $('.add-to-cart-cmd').on('click', function () {
        $('#submit').html('确定').data('action', 'cart');

    });

    $('.buy-immediately').on('click', function () {
        $('#submit').html('确认购买').data('action', 'buy');
    });

    $('#submit').on('click', function (event) {
        let data = {
            size: $('.size.active').data('size-id'),
            quantity: $('#quantity').val(),
            item_id: '{{ $item->id }}',
        };

        if (data.size === undefined) {
            alert('请先选择尺码');
            return false;
        }

        if ($(event.target).data('action') === 'cart') {
            $.ajax({
                url: '{{ route('cart.store') }}',
                method: 'POST',
                data: data,
                success: function () {
                    window.location.href = '{{ route('cart.index') }}';
                }
            });
        } else {

        }
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
