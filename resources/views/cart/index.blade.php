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
    <title>我的购物车 - {{ env('APP_NAME') }}</title>
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
            background-color: #ff5859;
        }

        .submit {
            border: 0;
            padding: 0;
            height: 100%;
            width: 30%;
            color: #FFF;
        }

        .submit.disabled {
            background-color: #e0e0e0;
            color: #9b9b9b;
        }

        .buy-button {
            height: 50px;
            width: 100%;
            font-size: 14px;
            padding: 0;
        }

        .card {
            margin-top: 10px;
        }

        .card-body {
            padding: 0.5em;
        }

        .price {
            color: #ff5859;
            font-weight: 700;
        }

        .navbar {
            height: 44px;
        }

        .inner-box {
            margin-top: 35px;
        }

        .row {
            margin: 0 -9px;
        }

        .edit {
            display: none;
            flex: 0 0 55%;
        }

        .cards.editing .edit {
            display: block;
        }

        .cards.editing .info {
            display: none;
        }

        .col-7 {
            padding-right: 0;
            padding-left: 0;
            flex: 0 0 55%;
        }

        .delete {
            position: absolute;
            top: 0;
            right: 0;
            border: 0;
            color: #FFF;
            background-color: #ff5859;
            height: 100%;
            width: 20%;
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
            left: 34%;
            transform: translate(-50%, -50%) scale(0.05);
        }
    </style>
    
</head>
@inject('style', 'App\Models\Style')
<body>
<div class="my-container">
    <div class="sticky-top">
        <nav class="navbar navbar-light">
            <a class="navbar-brand" href="javascript:history.back()">
                <i class="fa fa-chevron-left" style="font-size: 12px; color: black;"></i>
            </a>
            <b><span>我的购物车</span></b>
            <b><span id="toggle-edit">编辑</span></b>
        </nav>
    </div>
    <div class="cards">
        @foreach($contents as $content)
            <div class="card border-light" id="card-{{ $content->rowId }}">
                <div class="card-body text-dark">
                    <div class="row">
                        <div class="col-1">
                            <label class="custom-control custom-checkbox inner-box">
                                <input type="checkbox" data-row-id="{{ $content->rowId }}"
                                       data-subtotal="{{ $content->subtotal }}"
                                       class="custom-control-input each-checkbox" checked>
                                <span class="custom-control-indicator"></span>
                            </label>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('items.show', $content->id) }}">
                                <div class="img-container">
                                    <img class="top" src="{{ $content->model->front_uri }}" alt="front">
                                    <img style="background-color: {{ $content->model->color->value }};" class="bottom"
                                         src="{{ $content->model->style->front_uri }}" alt="style->front">
                                </div>
                            </a>
                        </div>
                        <div class="col-7">
                            <div class="info">
                                <p class="mb-0">{{ $content->model->user->name }}的{{ $content->name }}</p>
                                <small class="text-muted">
                                    {{ $content->name }}
                                    {{ $style::sizes[$content->options->size] }}
                                </small>
                                <p class="mb-0">
                                    <span class="price">&yen;{{ $content->subtotal }}</span>
                                    <small class="text-muted pull-right">
                                        x{{ $content->qty }}
                                    </small>
                                </p>
                            </div>
                            <div class="edit">
                                <div class="quantity" style="width: 75%;">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn btn-outline-secondary minus" type="button"
                                                    data-target-row-id="{{ $content->rowId }}">-</button>
                                        </span>
                                        <input title="qty" type="number" min="1"
                                               class="form-control qty-input" id="quantity-{{ $content->rowId }}"
                                               value="{{ $content->qty }}" data-row-id="{{ $content->rowId }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-outline-secondary plus" type="button"
                                                    data-target-row-id="{{ $content->rowId }}">+</button>
                                        </span>
                                    </div>
                                </div>
                                <select class="custom-select form-control size-selection"
                                        title="size" style="margin-top: 20px;width: 75%;"
                                        data-row-id="{{ $content->rowId }}">
                                    @foreach($content->model->style->parse_size() as $key => $value)
                                        @if($key == $content->options->size)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="button" class="delete" data-row-id="{{ $content->rowId }}">删除</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mb-5"></div>
    <nav class="navbar fixed-bottom  buy-button">
        <label class="custom-control custom-checkbox mb-0 ml-2">
            <input type="checkbox" class="custom-control-input" id="choose-all" checked>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">全选</span>
        </label>
        <span>合计: <span class="price">&yen; <span id="subtotal">{{ $subtotal }}</span></span></span>
        <input class="submit red" id="submit-button" data-action="submit" type="button" value="结算">
    </nav>
</div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script>
    // function
    function delete_item(row_id) {
        $.ajax({
            url: '{{ route('cart.index') }}' + '/' + row_id.join(','),
            method: 'DELETE',
            success: function (res) {
                $('#subtotal').text(res.data.subtotal);
            }
        });

        row_id.forEach(function (each) {
            $('#card-' + each).remove();
        });
    }

    // event
    $('#toggle-edit').on('click', function () {
        let cards = $('.cards');
        let toggle_edit = $('#toggle-edit');
        if (cards.hasClass('editing')) {
//            cards.removeClass('editing');
//            $('#toggle-edit').html('编辑');
//            return true;
            location.reload();
        }
        cards.addClass('editing');
        toggle_edit.html('完成');
        $('#submit-button').val('删除').data('action', 'delete');
    });

    $('.delete').on('click', function (event) {
        delete_item([$(event.target).data('row-id')]);
    });

    $('.plus').on('click', function (event) {
        let quantity = $('#quantity-' + $(event.target).data('target-row-id'));
        let res = parseInt(quantity.val()) + 1;
        quantity.val(res).trigger('input');
    });

    $('.minus').on('click', function () {
        let quantity = $('#quantity-' + $(event.target).data('target-row-id'));
        let res = parseInt(quantity.val()) - 1;
        res = res < 1 ? 1 : res;
        quantity.val(res).trigger('input');
    });

    $('.qty-input').on('input', function (event) {
        let target = $(event.target);

        if (!event.target.value) {
            $(event.target).val(1);
        }

        $.ajax({
            url: '{{ route('cart.index') }}' + '/' + target.data('row-id'),
            method: 'PUT',
            data: {
                'type': 'qty',
                'qty': target.val()
            },
            success: function (res) {
                $('#subtotal').text(res.data.subtotal);
            }
        });
    });

    $('.size-selection').on('change', function (event) {
        $.ajax({
            url: '{{ route('cart.index') }}' + '/' + $(event.target).data('row-id'),
            method: 'PUT',
            data: {
                'type': 'size',
                'size': event.target.value
            },
//            success: function (res) {
//                $('#subtotal').text(res.data.subtotal);
//            }
        });
    });

    $('.each-checkbox').on('change', function (event) {
        let total_length = $('.each-checkbox').length;
        let checked_length = $('.each-checkbox:checked').length;
        let subtotal = parseInt($('#subtotal').text());
        let submit_button = $('#submit-button');

        if ($(event.target).prop('checked') === false) {
            subtotal -= $(event.target).data('subtotal');
        } else {
            subtotal += $(event.target).data('subtotal');
        }

        $('#subtotal').text(subtotal);

        if (checked_length === 0) {
            submit_button.addClass('disabled');
        } else {
            submit_button.removeClass('disabled');
        }

        if (checked_length < total_length) {
            $('#choose-all').prop('checked', false);
        } else {
            $('#choose-all').prop('checked', true);
        }
    });

    $('#choose-all').on('change', function (event) {
        if ($(event.target).prop('checked')) {
            $('.each-checkbox').prop('checked', true);
            $('#subtotal').text({{ $subtotal }});
            $('#submit-button').removeClass('disabled');
            return true;
        }

        $('.each-checkbox').prop('checked', false);
        $('#subtotal').text(0);
        $('#submit-button').addClass('disabled');
    });

    $('#submit-button').on('click', function (event) {
        let target = $(event.target);
        let action = target.data('action');
        let will_do = [];
        $('.each-checkbox:checked').each(function (key, value) {
            will_do.push($(value).data('row-id'));
        });
        if (will_do.length === 0) {
            return false;
        }
        if (action === 'delete') {
            delete_item(will_do);
        } else if (action === 'submit') {
            let $form = $("<form method='POST' action='{{ route('orders.create') }}'></form>");
            $form.append($('<input type="hidden" name="row_ids" value="">').val(JSON.stringify(will_do)));
            $form.append('{{ csrf_field() }}');
            $(document.body).append($form);
            $form.submit();
        } else {
            return false;
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
