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
        body {
            background-color: #f4f7fa;
        }

        .sticky-top {
            background-color: white;
        }

        .fixed-bottom {
            background-color: white;
        }

        .red {
            background-color: #ff5859;
        }

        .custom-control-input:checked ~ .custom-control-indicator {
            color: #fff;
            background-color: #ff5859;
        }

        .submit {
            border: 0;
            padding: 0;
            height: 100%;
            width: 30%;
            color: #FFF;
        }

        .buy-button {
            height: 50px;
            width: 100%;
            font-size: 14px;
            padding: 0;
        }

        .cards {
            margin-top: 10px;
        }

        .margin-bottom {
            margin-bottom: 60px;
        }
    </style>
    <title>Laravel</title>
</head>
<body>
<div class="my-container">
    <div class="sticky-top">
        <nav class="navbar navbar-light">
            <a class="navbar-brand" href="javascript:history.back()">
                <i class="fa fa-chevron-left" aria-hidden="true" style="font-size: 16px; color: rgb(203,203,203);"></i>
            </a>
            <span>我的购物车</span>
            <a href=""></a>
        </nav>
    </div>
    @foreach($contents as $content)
        <div class="cards">
            <div class="card bg-light">
                <div class="card-body text-dark">
                    <div class="row">
                        <div class="col-1">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>
                        </div>
                        <div class="col-4">
                            <img src="{{ $content->model->style->front_uri }}" class="img-fluid" alt="thumbnail">
                        </div>
                        <div class="col-6">3</div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="margin-bottom"></div>
    <nav class="navbar fixed-bottom  buy-button">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">全选</span>
        </label>
        <span>合计: &yen;</span>
        <input class="submit red" type="button" value="结算">
    </nav>
</div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script>

</script>
</body>
</html>