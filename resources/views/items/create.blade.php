<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="theme-color" content="#db5945">
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
            top: 48%;
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
            top: 85%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .fixed-bottom {
            background-color: white;

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
    <title>Laravel</title>
</head>
<body>
<nav class="navbar navbar-light" style="background-color: white;">
    <a class="navbar-brand" href="javascript:history.back()">
        <i class="fa fa-chevron-left" aria-hidden="true" style="font-size: 16px; color: rgb(203,203,203);"></i>
    </a>
    <span style="font-size:15px;">
        品类 款式 颜色
        <i class="fa fa-chevron-down" aria-hidden="true" style="font-size: 12px; color: rgb(203,203,203);"></i>
    </span>
    {{--btn-secondary 4 disabled, btn-warning 4 enabled--}}
    <button id="submit-button" type="button" class="btn btn-secondary btn-sm" disabled>完成定制</button>
</nav>
<div class="container">
    <div class="canvas-wrap">
        <div class="canvas-item front-side">
            <div class="canvas-background">
                <img src="/img/front.png"
                     alt="" class="bg-img">
            </div>

            <canvas id="front-side-container"></canvas>
        </div>
        <div class="canvas-item back-side collapse">
            <div class="canvas-background">
                <img src="/img/back.png"
                     alt="" class="bg-img">
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

</div>
<script src="https://cdn.bootcss.com/fabric.js/1.7.17/fabric.min.js"></script>
<script src="/js/customiseControls.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script>
    // settings
    fabric.Canvas.prototype.customiseControls({
        tl: {
            action: 'move',
            cursor: 'pointer'
        },
        tr: {
            action: 'rotate',
            cursor: 'pointer'
        },
        bl: {
            action: 'remove',
            cursor: 'pointer'
        },
        br: {
            action: 'scale',
            cursor: 'pointer'
        }
    });
    fabric.Object.prototype.customiseCornerIcons({
        settings: {
            borderColor: '#0094dd',
            cornerSize: 50,
            cornerShape: 'circle',
//            cornerShape: 'rect',
            cornerBackgroundColor: 'gray',
        },
        tl: {
            icon: '/img/move.png',
        },
        tr: {
            icon: '/img/rotate.png',
        },
        bl: {
            icon: '/img/remove.png',
        },
        br: {
            icon: '/img/resize.png',
        },
    });

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
        'object:scaling': updateControls,
        'object:resizing': updateControls,
        'object:rotating': updateControls,
        'object:selected': function (obj) {
            if (deleting === true) {
                // mobile platform problem
                canvas.deactivateAllWithDispatch().renderAll();
                deleting = false;
                return;
            }
            selected_object = obj.target;
            updateControls();
            $('.canvas-container').css('border', '1px solid');
            $('.controls').show();
        },
        'selection:cleared': onSelectionCleared,
        'object:added': function (obj) {
            object_count++;
            obj.target.center().setCoords();
        },
        'object:removed': function () {
            object_count--;
            deleting = true;
            onSelectionCleared();
            // todo: disable submit button
        },
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


    // logic
    var rect_f = new fabric.Circle({
        radius: 100,
        fill: 'rgba(255,0,0,0.6)'
    });
    var rect_b = new fabric.Circle({
        radius: 100,
        fill: 'rgba(255,0,0,0.6)'
    });

    front_side.add(rect_f);
    back_side.add(rect_b);
</script>
</body>
</html>
