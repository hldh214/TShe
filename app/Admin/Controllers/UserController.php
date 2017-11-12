<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Routing\Route;

class UserController extends Controller
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
            $content->header('会员列表');

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

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(User::class, function (Grid $grid) {
            $grid->filter(function($filter){
                $filter->equal('name', '昵称');
                $filter->equal('email', '邮箱');
            });

            $grid->id('ID')->sortable();
            $grid->name('昵称');
            $grid->email('邮箱');
            $grid->avatar('头像')->image(null, 100, 100);
            $grid->point('积分');
//            $grid->type('类型')->display(function ($type) {
//                return User::type[$type];
//            });
            $grid->created_at();
            $grid->updated_at();

            $grid->disableCreation();

            $grid->actions(function ($actions) {
                $actions->prepend('<a href="' . url('/admin/orders') . '?user_id=' . $actions->getKey() . '">查看订单</a>|');
                $actions->prepend('<a href="' . url('/admin/addresses') . '?user_id=' . $actions->getKey() . '">查看收货地址</a>|');
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('name', '昵称');
            $form->text('email', '邮箱');
            $form->image('avatar', '头像');
            $form->number('point', '积分');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
