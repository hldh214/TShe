<?php

namespace App\Admin\Controllers;

use App\Models\Order;

use App\Models\Style;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class OrderController extends Controller
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

            $content->header('订单列表');

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
        return Admin::grid(Order::class, function (Grid $grid) {
            $style = new Style();
            $grid->id('ID')->sortable();
            $grid->user()->name('用户');
            $grid->item('商品列表')->reduce(function ($carry, $item) use ($style) {
                return $carry . "<p>尺寸:{$style::sizes[$item['size']]} 数量:{$item['qty']}<a href='/admin/items?&id={$item['item_id']}'>查看商品</a></p>";
            }, '');
            $grid->address('收货地址')->display(function () {
                return "<p>
                            <span>{$this->address['name']}</span>
                            <span>{$this->address['phone']}</span>
                        </p>
                        <p>
                            <span class=\"province\" data-no=\"{$this->address['province']}\"></span>
                            <span class=\"city\" data-no=\"{$this->address['city']}\"></span>
                            <span class=\"district\" data-no=\"{$this->address['district']}\"></span>
                        </p>
                        <p>{$this->address['address']}</p>";
            });
            $grid->comment('买家留言');
            $grid->amount('总金额');
            $grid->status('状态')->editable('select', Order::status);
            $grid->disableCreation();
            $grid->disableActions();
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
        return Admin::form(Order::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->display('status', '状态');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
