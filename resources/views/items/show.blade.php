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
            /*width: 40%;*/
            top: 58%;
            left: 49.5%;
            transform: translate(-50%, -50%) scale(0.2);
        }
    </style>
    <title>Laravel</title>
</head>
<body>
<div class="container-fluid" style="padding: 0;">
    <div class="slider">
        <div class="swiper-container" style="background-color: #f4f7fa;">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="img-container">
                        <img class="top" src="/uploads/{{ $item->front }}" alt="front">
                        <img style="background-color: {{ $item->color->value }};" class="bottom" src="/uploads/{{ $item->style->front }}" alt="style->front">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="img-container">
                        <img class="top" src="/uploads/{{ $item->back }}" alt="back">
                        <img style="background-color: {{ $item->color->value }};" class="bottom" src="/uploads/{{ $item->style->back }}" alt="style->back">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="info"></div>
    <div class="select-modal-trigger"></div>
    <div class="detail"></div>
    <nav class="navbar fixed-bottom  buy-button">
        <a href="" class=" shopping-cart">
            <div class="icon-wrapper">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="badge badge-light">0</span>
            </div>
            <p>购物车</p>
        </a>
        <input class="add-to-cart" type="button" value="加入购物车">
        <input class="buy-immediately" type="button" value="立即购买">
    </nav>
</div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/Swiper/3.4.2/js/swiper.jquery.min.js"></script>
<script>
    // slider
    new Swiper('.swiper-container', {
        loop: true,
        pagination: '.swiper-pagination',
        paginationClickable: true,
    })


    // initial
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
