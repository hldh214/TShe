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
            text-align: center;
        }

        .canvas-background {
            background-color: whitesmoke;
            position: absolute;
        }

        .bg-img {
            box-sizing: border-box;
            vertical-align: middle;
            border: 0;
            width: 100%;
        }

        .canvas-item {
            width: 450px;
            height: 514px;
            position: absolute;
            top: 44%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.7);
        }

        .canvas-container {
            left: 222px;
            top: 300px;
            transform: translate(-50%, -50%) scale(0.7);
        }

        .switch {
            position: absolute;
            top: 79%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .fixed-bottom {
            background-color: white;
        }

        .nowrap {
            white-space:nowrap;
            margin: auto;
            margin-right: 5px;
        }

        .mb-15 {
            margin-bottom: 15px;
        }

        .tooltip-inner {
            background-color: #ff6f6f;
        }

        .tooltip.bs-tooltip-auto[x-placement^=bottom] .arrow::before, .tooltip.bs-tooltip-bottom .arrow::before {
            border-bottom-color: #ff6f6f;
        }
    </style>
    <style>
        /*https://css-tricks.com/styling-cross-browser-compatible-range-inputs-css/*/
        input[type=range] {
            -webkit-appearance: none;
            margin: 18px 0;
            /*width: 100%;*/
        }

        input[type=range]:focus {
            outline: none;
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
            background: #3071a9;
            border-radius: 1.3px;
            border: 0.2px solid #010101;
        }

        input[type=range]::-webkit-slider-thumb {
            box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
            border: 1px solid #000000;
            height: 36px;
            width: 16px;
            border-radius: 3px;
            background: #ffffff;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -14px;
        }

        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #367ebd;
        }

        input[type=range]::-moz-range-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
            background: #3071a9;
            border-radius: 1.3px;
            border: 0.2px solid #010101;
        }

        input[type=range]::-moz-range-thumb {
            box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
            border: 1px solid #000000;
            height: 36px;
            width: 16px;
            border-radius: 3px;
            background: #ffffff;
            cursor: pointer;
        }

        input[type=range]::-ms-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            animate: 0.2s;
            background: transparent;
            border-color: transparent;
            border-width: 16px 0;
            color: transparent;
        }

        input[type=range]::-ms-fill-lower {
            background: #2a6495;
            border: 0.2px solid #010101;
            border-radius: 2.6px;
            box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        }

        input[type=range]::-ms-fill-upper {
            background: #3071a9;
            border: 0.2px solid #010101;
            border-radius: 2.6px;
            box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        }

        input[type=range]::-ms-thumb {
            box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
            border: 1px solid #000000;
            height: 36px;
            width: 16px;
            border-radius: 3px;
            background: #ffffff;
            cursor: pointer;
        }

        input[type=range]:focus::-ms-fill-lower {
            background: #3071a9;
        }

        input[type=range]:focus::-ms-fill-upper {
            background: #367ebd;
        }
    </style>
    <style>
        /*https://o86bsrpha.qnssl.com/assets/java_mobile_editors_bundle-4d8b6fa5312559f75405.css*/
        .icon_image {
            background: url(/img/image.png) no-repeat
        }

        .icon_txt {
            background: url(/img/txt.png) no-repeat
        }

        .me_icon {
            display: inline-block;
            width: 24px;
            height: 24px;
            background-size: 24px 24px
        }

        .options_icon_picture {
            position: absolute;
            top: -44%;
            left: 50%;
            padding: 8px;
            width: 64px;
            height: 64px;
            background: #fff;
            box-shadow: 0 -3px 5px rgba(55, 52, 52, .05);
            border-radius: 100px;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%)
        }

        .icon_picture {
            display: inline-block;
            height: 100%;
            background: url(/img/picture.png) no-repeat;
            background-size: 48px 48px;
            width: 100%;
            transition: -webkit-transform .05s;
            transition: transform .05s;
            transition: transform .05s, -webkit-transform .05s;
            box-shadow: 0 3px 6px rgba(255, 204, 101, .5);
            border-radius: 50%;;
        }

        .options {
            position: relative;
            bottom: 0;
            height: 60px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, .5);
            transition: bottom .25s
        }

        .options_select {
            width: 100%;
            height: 100%;
            text-align: center;
            overflow-x: scroll;
            overflow-y: hidden
        }

        .options_select_box {
            display: inline-block
        }

        .options_select_item {
            display: inline-block;
            width: 92px;
            height: 60px;
            text-align: center;
            color: #141414;
            font-size: 0
        }

        .options_select_item.options_item_relative {
            position: relative
        }

        .options_select_item .me_icon {
            margin-top: 10px
        }

        .options_item_txt {
            margin-top: 3px;
            color: #767676;
            font-size: 12px
        }

        .options_input_file {
            display: inline-block;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2;
            width: 100%;
            height: 100%;
            opacity: 0
        }
    </style>
    <style>
        #loading {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            opacity: 0.7;
            background-color: #fff;
            z-index: 1031;
            text-align: center;
        }

        #loading-image {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            position: absolute;
            z-index: 1032;
        }
    </style>
    <style>
        .tooltip {
            z-index: 1049;
        }
    </style>
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
<div id="loading">
    <img id="loading-image" src="/img/loading.gif" />
</div>
<nav class="navbar navbar-light" style="background-color: white; height: 44px;">
    <a class="navbar-brand" href="javascript:history.back()">
        <i class="fa fa-chevron-left" aria-hidden="true" style="font-size: 16px; color: rgb(203,203,203);"></i>
    </a>
    <span style="font-size:15px;" data-toggle="modal" data-target="#cate-modal">
        品类 款式 颜色
        <i class="fa fa-chevron-down" aria-hidden="true" style="font-size: 12px; color: rgb(203,203,203);"></i>
    </span>
    {{--btn-secondary 4 disabled, btn-warning 4 enabled--}}
    <button id="submit-button" type="button" class="btn btn-secondary btn-sm" disabled
    @if($user->coupons->where('id', 1)->isNotEmpty())
    data-toggle="tooltip" data-placement="bottom" title="{{ $user->coupons->where('id', 1)->first()->name }}"
    @endif
    >完成定制</button>
</nav>
<div class="container">
    <div class="canvas-wrap">
        <div class="canvas-item front-side">
            <div class="canvas-background">
                <img src=""
                     alt="front" class="bg-img" id="front-img">
            </div>

            <canvas id="front-side-container"></canvas>
        </div>
        <div class="canvas-item back-side collapse">
            <div class="canvas-background">
                <img src=""
                     alt="back" class="bg-img" id="back-img">
            </div>

            <canvas id="back-side-container"></canvas>
        </div>
    </div>
    <div class="switch">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-light active btn-sm">
                <input type="radio" autocomplete="off" value="front-side" checked>
                正面
            </label>
            <label class="btn btn-light btn-sm">
                <input type="radio" autocomplete="off" value="back-side">
                背面
            </label>
        </div>
    </div>
</div>
<div class="fixed-bottom">
    <div class="controls collapse">
        <p>
            <label>
                <span>旋转</span>
                <input type="range" id="angle-control" value="0" min="0" max="360">
            </label>
        </p>
        <p>
            <label>
                <span>大小</span>
                <input type="range" id="scale-control" value="1" min="0.1" max="3" step="0.1">
            </label>
        </p>
    </div>
    <div class="options"><div class="options_select"><div class="options_select_box" style="width: 276px;"><div class="options_select_item options_item_relative invisible"><i class="me_icon icon_image"></i><div class="options_item_txt">相册</div><input type="file" class="options_input_file editor-active" id="materials-upload"></div><div class="options_select_item" id="show-materials-modal"><div class="options_select_item options_item_relative"><i class="me_icon"></i><div class="options_item_txt">素材库</div></div><div class="options_icon_picture"><i class="icon_picture"></i></div></div><div class="options_select_item invisible" id="show-words-modal"><i class="me_icon icon_txt"></i><div class="options_item_txt">文字</div></div></div></div></div>
</div>
<div class="modal fade" id="materials-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">素材库</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="accordion">
                    @foreach($material_types as $material_type)
                        <div class="card">
                            <div class="card-header" role="tab">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" href="#collapse{{ $material_type->id }}">
                                        {{ $material_type->name }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse{{ $material_type->id }}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        @foreach($material_type->materials->chunk(3) as $materials)
                                            <div class="row">
                                                @foreach($materials as $material)
                                                    <div class="col">
                                                        <img class="img-fluid"
                                                             data-src="{{ $material->full_uri }}"
                                                             src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                        >
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="words-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">编辑文字</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <textarea class="form-control" placeholder="请输入要定制的文字" id="word"></textarea>
                        </div>
                        <div class="col">
                            <button class="btn btn-warning btn-lg" type="button" id="set-word">完成</button>
                        </div>
                    </div>
                </div>
                <div class="list-group">
                    @foreach($words as $word)
                        <a class="list-group-item list-group-item-action flex-column align-items-start word-item"
                           data-content="{{ $word->content }}">
                            <div>
                                <pre style="font-size: 16px">{{ $word->content }}</pre>
                            </div>
                            <small class="text-muted">{{ $word->comment }}</small>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cate-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="overflow: auto;">
                <div id="categories" class="btn-group btn-group-sm mb-15" data-toggle="buttons">
                    <span class="nowrap">品类: </span>
                    @foreach($categories as $category)
                        <label class="btn btn-outline-warning category" data-category-id="{{ $category->id }}">
                            <input type="radio">{{ $category->name }}
                        </label>
                    @endforeach
                </div>

                <div id="styles" class="btn-group btn-group-sm mb-15" data-toggle="buttons">
                    <label class="nowrap">款式: </label>

                </div>

                <div id="colors" class="btn-group btn-group-sm mb-15" data-toggle="buttons">
                    <label class="nowrap">颜色: </label>

                </div>
            </div>
        </div>
    </div>
</div>
<div data-backdrop="static" class="modal fade" id="submit-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated"
                         style="width: 100%; height: 40px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.bootcss.com/fabric.js/1.7.17/fabric.min.js"></script>
<script src="/js/customiseControls.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/jquery.lazyloadxt/1.1.0/jquery.lazyloadxt.min.js"></script>
<script src="https://cdn.bootcss.com/jquery.lazyloadxt/1.1.0/jquery.lazyloadxt.bootstrap.min.js"></script>
<script>
    // settings
//    fabric.Canvas.prototype.customiseControls({
//        tl: {
//            action: 'move',
//            cursor: 'pointer'
//        },
//        tr: {
//            action: 'rotate',
//            cursor: 'pointer'
//        },
//        bl: {
//            action: 'remove',
//            cursor: 'pointer'
//        },
//        br: {
//            action: 'scale',
//            cursor: 'pointer'
//        }
//    });
//    fabric.Object.prototype.customiseCornerIcons({
//        settings: {
//            borderColor: '#0094dd',
//            cornerSize: 50,
//            cornerShape: 'circle',
////            cornerShape: 'rect',
//            cornerBackgroundColor: 'gray',
//        },
//        tl: {
//            icon: '/img/move.png',
//        },
//        tr: {
//            icon: '/img/rotate.png',
//        },
//        bl: {
//            icon: '/img/remove.png',
//        },
//        br: {
//            icon: '/img/resize.png',
//        },
//    });

    fabric.Object.prototype.setControlsVisibility({
        mt: false, // middle top disable
        mb: false, // midle bottom
        ml: false, // middle left
        mr: false, // I think you get it
        mtr: false
    });
    fabric.Object.prototype.centeredScaling = true;
    fabric.Object.prototype.originX = 'center';
    fabric.Object.prototype.originY = 'center';
    fabric.Object.prototype.allowTouchScrolling = true;
    fabric.Object.prototype.controlsAboveOverlay = true;
    fabric.Canvas.prototype.selection = false;
    fabric.Canvas.prototype.height = '360';
    fabric.Canvas.prototype.width = '280';

    // dumb
    fabric.Object.prototype.lockMovementX = true;
    fabric.Object.prototype.lockMovementY = true;
    fabric.Object.prototype.lockScalingX = true;
    fabric.Object.prototype.lockScalingY = true;
    fabric.Object.prototype.lockUniScaling = true;
    fabric.Object.prototype.lockRotation = true;

    var selected_object = null;
    var canvas = null;
    // object:removed && object:selected will called together
    var deleting = false;
    var object_count = 0;

    var front_side = new fabric.Canvas('front-side-container');
    var back_side = new fabric.Canvas('back-side-container');

    canvas = front_side;


    // functions
    function updateControls() {
        scaleControl.val(selected_object.scaleX);
        angleControl.val(selected_object.angle);
    }

    function onSelectionCleared() {
        $('.canvas-container').css('border', '');
        $('.controls').hide();
        $('.options').show();
    }


    // events
    var angleControl = $('#angle-control');
    angleControl.on('input', function () {
        selected_object.set('angle', parseInt(this.value, 10)).setCoords();
        canvas.renderAll();
    });

    var scaleControl = $('#scale-control');
    scaleControl.on('input', function () {
        selected_object.scale(parseFloat(this.value)).setCoords();
        canvas.renderAll();
    });

    $('.navbar, .navbar *, .canvas-background, .switch').on('click', function () {
        canvas.deactivateAllWithDispatch().renderAll();
    })

    var fabric_event = {
//        'object:scaling': updateControls,
//        'object:resizing': updateControls,
//        'object:rotating': updateControls,
//        'object:selected': function (obj) {
//            if (deleting === true) {
//                // mobile platform problem
//                canvas.deactivateAllWithDispatch().renderAll();
//                deleting = false;
//                return;
//            }
//            selected_object = obj.target;
//            updateControls();
//            $('.canvas-container').css('border', '1px solid');
//            $('.controls').show();
//            $('.options').hide();
//        },
//        'selection:cleared': onSelectionCleared,
        'object:added': function (obj) {
            object_count++;
            console.log(obj.target);
            obj.target.center().setCoords();
        },
//        'object:removed': function () {
//            object_count--;
//            deleting = true;
//            onSelectionCleared();
//        },
        'after:render': function () {
            if (object_count === 0) {
                $('#submit-button').prop('disabled', true).addClass('btn-secondary').removeClass('btn-warning');
                return;
            }
            $('#submit-button').prop('disabled', false).addClass('btn-warning').removeClass('btn-secondary');
        }
    };

    front_side.on(fabric_event);
    back_side.on(fabric_event);

    $('.switch').on('change', function (obj) {
        if (obj.target.value === 'front-side') {
            $('.front-side').show();
            $('.back-side').hide();
            canvas = front_side;
            return null;
        }
        $('.back-side').show();
        $('.front-side').hide();
        canvas = back_side;
    });

    $('#show-materials-modal').on('click', function () {
        $('#materials-modal').modal();
    });

    $('#show-words-modal').on('click', function () {
        $('#word').val('');
        $('#words-modal').modal();
    });

    $('.img-fluid').on('click', function (event) {
        canvas.add(new fabric.Image(event.target));
        $('#materials-modal').modal('hide');
    });

    $('#set-word').on('click', function () {
        canvas.add(new fabric.Text($('#word').val()));
        $('#words-modal').modal('hide');
    });

    $('#materials-upload').on("change", function (e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function (f) {
            var data = f.target.result;
            fabric.Image.fromURL(data, function (img) {
                canvas.add(img).renderAll();
                canvas.setActiveObject(img);
            });
        };
        reader.readAsDataURL(file);
    });

    $('.word-item').on('click', function (event) {
        $('#word').val($(event.currentTarget).data('content'));
    });

    $('.category').on('click', function (event) {
        var found_styles = $.grep(styles, function (v) {
            return v.category_id === $(event.target).data('category-id');
        });

        $('.style').remove();

        found_styles.forEach(function (each) {
            $('#styles').append(
                '<label class="btn btn-outline-warning style" data-style-id="'
                + each.id + '"><input '
                + 'type="radio">' + each.name + '</label>'
            );
        });

        $('.style:first').click();
    });

    // dynamic binding
    $(document).on('click', '.style', function (event) {
        var found_colors = $.grep(colors, function (v) {
            return v.style_id === $(event.target).data('style-id');
        });

        var current_style = $.grep(styles, function (v) {
            return v.id === $(event.target).data('style-id');
        })[0];

        $('#front-img').attr('src', current_style.front_uri);
        $('#back-img').attr('src', current_style.back_uri);

        $('.color').remove();

        found_colors.forEach(function (each) {
            $('#colors').append(
                '<label class="btn btn-outline-warning color" data-color-id="'
                + each.id + '"><input '
                + 'type="radio">' + each.name + '</label>'
            );
        });

        $('.color:first').click();
    });

    $(document).on('click', '.color', function (event) {
        var current_color = $.grep(colors, function (v) {
            return v.id === $(event.target).data('color-id');
        })[0];

        $('.canvas-background').css('background-color', current_color.value);
    });

    $('#submit-button').on('click', function () {
        $('#submit-modal').modal();

        $.ajax({
            url: '{{ route('items.store') }}',
            method: 'POST',
            data: {
                category_id: $('.category.active').data('category-id'),
                style_id: $('.style.active').data('style-id'),
                color_id: $('.color.active').data('color-id'),
                front: front_side.toDataURL({
                    multiplier: 2 / window.devicePixelRatio
                }),
                back: back_side.toDataURL({
                    multiplier: 2 / window.devicePixelRatio
                })
            },
            success: function (res) {
                window.location.href = '{{ route('items.index') }}/' + res.data.id;
            }
        });
    });


    // data assignment
    var styles = JSON.parse('{!! $styles !!}');
    var colors = JSON.parse('{!! $colors !!}');


    // inital
    $('.category:first').click();
    $('.style:first').click();
    $('.color:first').click();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#loading').hide();
        $('[data-toggle="tooltip"]').tooltip('show');
        @if(request()->has('type'))
            $('#collapse{{ request()->get('type') }}').addClass('show');
            $('#materials-modal').modal();
        @endif
    });
</script>
</body>
</html>
