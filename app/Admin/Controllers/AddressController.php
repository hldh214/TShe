<?php

namespace App\Admin\Controllers;

use App\Models\Address;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AddressController extends Controller
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
            $content->header('收货地址列表');

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
        return Admin::grid(Address::class, function (Grid $grid) {
            $grid->filter(function($filter){
                $filter->equal('user_id', 'user_id');
            });

            $grid->id('ID')->sortable();
            $grid->user()->name('用户');
            $grid->address('收货地址')->display(function () {
                return "<p>
                            <span>{$this->name}</span>
                            <span>{$this->phone}</span>
                        </p>
                        <p>
                            <span class=\"province\" data-no=\"{$this->province}\"></span>
                            <span class=\"city\" data-no=\"{$this->city}\"></span>
                            <span class=\"district\" data-no=\"{$this->district}\"></span>
                            <span>{$this->address}</span>
                        </p>";
            });
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
        return Admin::form(Address::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
