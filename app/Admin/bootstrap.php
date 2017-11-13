<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

\Encore\Admin\Form::forget(['map']);

\Encore\Admin\Form::extend('ckeditor', \App\Admin\Extensions\Form\CKEditor::class);

\Encore\Admin\Grid\Column::extend('color', function ($color, $type='value') {
    if ($type == 'value') {
        $content = $color;
    } elseif ($type == 'name') {
        $content = \App\Models\Color::where('value', $color)->withTrashed()->first()->name;
    } else {
        $content = $color;
    }

    return "<span style='color: {$color}'>{$content}</span>";
});

\Encore\Admin\Grid\Column::extend('parse_size', function ($size) {
    $res = [];
    foreach ($size as $each_size) {
        $res[] = self::sizes[$each_size];
    }
    return implode(',', $res);
});

\Encore\Admin\Admin::js('https://cdn.bootcss.com/distpicker/2.0.1/distpicker.min.js');
\Encore\Admin\Admin::js(asset('js/init_distpicker.js'));
