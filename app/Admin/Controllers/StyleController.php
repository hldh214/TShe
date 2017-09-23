<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Style;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class StyleController extends Controller
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
            $content->header('款式列表');
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
            $content->header('创建款式');
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
        return Admin::grid(Style::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->name('款式名称');
            $grid->category()->name('品类名称');
            $grid->front('正面款式')->image(null, 100, 100);
            $grid->back('反面款式')->image(null, 100, 100);
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
        return Admin::form(Style::class, function (Form $form) {
            $category = new Category();
            $category = $category->all()->mapWithKeys(function ($item) {
                return [$item['id'] => $item['name']];
            });

            $form->display('id', 'ID');
            $form->text('name', '款式名称');
            $form->image('front', '正面款式上传')->uniqueName();
            $form->image('back', '反面款式上传')->uniqueName();
            $form->select('category_id', '品类')->options($category);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
