<?php

namespace App\Admin\Controllers;

use App\Models\Color;

use App\Models\Style;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ColorController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('颜色列表');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('创建颜色');
            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Color::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->name('颜色名称');
            $grid->value('颜色值')->color();
            $grid->style()->name('款式名称');
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Color::class, function (Form $form) {
            $style = new Style();
            $style = $style->all()->mapWithKeys(function ($item) {
                return [$item['id'] => $item['name']];
            });
            $form->display('id', 'ID');
            $form->text('name', '颜色名称');
            $form->color('value', '颜色')->default('#ff69b3');
            $form->select('style_id', '款式')->options($style);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
