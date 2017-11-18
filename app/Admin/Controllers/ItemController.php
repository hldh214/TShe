<?php

namespace App\Admin\Controllers;

use App\Models\Item;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
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
            $content->header('商品列表');
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
        return Admin::grid(Item::class, function (Grid $grid) {
            $grid->disableActions();
            $grid->id('ID')->sortable();
            $grid->category()->name('品类');
            $grid->style()->name('款式');
            $grid->color()->value('颜色')->color('name');
            $grid->column('下载')->display(function () {
                $front_uri = 'item' . DIRECTORY_SEPARATOR . $this->id . '-front.png';
                $back_uri  = 'item' . DIRECTORY_SEPARATOR . $this->id . '-back.png';
                if (!Storage::disk('admin')->exists($front_uri)) {
                    $front       = Image::make(public_path(DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $this->front))->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $style_front = Image::make(public_path(DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $this->style['front']));
                    $style_front = Image::canvas($style_front->width(), $style_front->height(), $this->color['value'])->insert($style_front);
                    $style_front->insert($front, 'top', null, 330);
                    Storage::disk('admin')->put($front_uri, (string)$style_front->encode());
                }

                if (!Storage::disk('admin')->exists($back_uri)) {
                    $back       = Image::make(public_path(DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $this->back))->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $style_back = Image::make(public_path(DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $this->style['back']));
                    $style_back = Image::canvas($style_back->width(), $style_back->height(), $this->color['value'])->insert($style_back);
                    $style_back->insert($back, 'top', null, 330);
                    Storage::disk('admin')->put($back_uri, (string)$style_back->encode());
                }

                return "
<a href='/uploads/{$front_uri}' download='front-{$this->id}.png' target='_blank' class='btn btn-default'>正面</a>
<a href='/uploads/{$back_uri}' download='back-{$this->id}.png' target='_blank' class='btn btn-default'>反面</a>
";
            });
            $grid->column('正面')->display(function () {
                $front_uri = 'item' . DIRECTORY_SEPARATOR . $this->id . '-front.png';

                return "
<img src='/uploads/{$front_uri}' class='img img-thumbnail' style='max-width:100px;max-height:100px'/>
";
            });
            $grid->column('反面')->display(function () {
                $back_uri = 'item' . DIRECTORY_SEPARATOR . $this->id . '-back.png';

                return "
<img src='/uploads/{$back_uri}' class='img img-thumbnail' style='max-width:100px;max-height:100px'/>
";
            });
            $grid->disableCreation();
            $grid->paginate(5);
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
        return Admin::form(Item::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
