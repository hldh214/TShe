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
use Illuminate\Support\Facades\Storage;

class StyleController extends Controller
{
    use ModelForm;

    public function upload()
    {
        $param_name = 'upload';
        $request = request();
        if ($request->file($param_name)->isValid()) {
            $this->validate($request, [
                $param_name => 'required|image',
            ]);

            $funcNum = $request->get('CKEditorFuncNum');
            $path = $request->$param_name->store($param_name, 'admin');
            $url = Storage::disk('admin')->url($path);

            return "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '上传成功');</script>";
        }

        return response([
            'code' => 1
        ]);
    }

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
            $grid->size()->parse_size('尺寸');
            $grid->price('售价');
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
            $form->select('category_id', '品类')->options($category);
            $form->multipleSelect('size', '尺寸')->options(Style::sizes);
            $form->currency('price', '售价')->symbol('&yen;');
            $form->image('front', '正面款式上传')->uniqueName();
            $form->image('back', '反面款式上传')->uniqueName();
            $form->ckeditor('item_detail', '产品详情');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
