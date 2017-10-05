<?php

namespace App\Admin\Controllers;

use App\Models\Material;

use App\Models\MaterialType;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class MaterialController extends Controller
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

            $content->header('素材列表');

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
            $content->header('创建素材');

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
        return Admin::grid(Material::class, function (Grid $grid) {
            $grid->filter(function ($filter) {
                $material_types = MaterialType::all();
                $filter->equal('material_type_id', '分类名称')->select($material_types->mapWithKeys(function ($item) {
                    return [$item['id'] => $item['name']];
                }));
            });

            $grid->id('素材ID')->sortable();
            $grid->material_type()->name('分类');
            $grid->uri('素材内容')->image(null, 100, 100);
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
        return Admin::form(Material::class, function (Form $form) {
            $materialType = new MaterialType();
            $materialType = $materialType->all()->mapWithKeys(function ($item) {
                return [$item['id'] => $item['name']];
            });

            $form->display('id', 'ID');
            $form->image('uri', '素材上传')->uniqueName();
            $form->select('material_type_id', '素材分类')->options($materialType);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
