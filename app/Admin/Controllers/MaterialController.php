<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\BulkInsert;
use App\Models\Material;

use App\Models\MaterialType;
use Chumper\Zipper\Zipper;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;

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

//            $grid->tools(function ($tools) {
//                $tools->append(new BulkInsert());
//            });

            $grid->id('素材ID')->sortable();
            $grid->material_type()->name('分类');
            $grid->uri('素材内容')->image(null, 100, 100);
            $grid->thumb('缩略图')->image(null, 100, 100);
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
            $form->image('thumb', '缩略图')->uniqueName();
            $form->select('material_type_id', '素材分类')->options($materialType);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function bulk_insert_create()
    {
        return Admin::content(function (Content $content) {
            $content->header('批量创建素材');

            $content->body(Admin::form(Material::class, function (Form $form) {
                $materialType = new MaterialType();
                $materialType = $materialType->all()->mapWithKeys(function ($item) {
                    return [$item['id'] => $item['name']];
                });

                $form->tools(function (Form\Tools $tools) {
                    $tools->disableListButton();
                });
                $form->disableReset();
                $form->disableSubmit();

                $form->image('uri', '素材 Zip 压缩包')->options(['showPreview' => false,]);
                $form->file('thumb', '缩略图 Zip 压缩包')->options(['showPreview' => false,]);
                $form->select('material_type_id', '素材分类')->options($materialType);
                $url  = route('bulk_insert.store');
                $html = <<<HTML
<button id="submit" class="btn btn-info pull-right">提交</button>
<script>
    $('form').prop('action', '{$url}');
</script>
HTML;

                $form->html($html);
                $form->divide();
                $form->display(null, '使用说明')->with(function () {
                    return <<<HTML
<pre>
将一一对应的素材图和缩略图重命名为相同的文件名, 进行 zip 压缩, 如图
值得注意的几点:
1. 对应的一对图片只要求文件名相同, 扩展名可以不同
2. 压缩包必须是 zip 格式
3. 压缩包必须按照图片所示的格式, 不能带有子目录
<img src="/img/bulk_insert_intro.jpg" />
</pre>
HTML;
                });
            }));
        });
    }

    public function bulk_insert_store()
    {
        if (request()->has(['uri', 'thumb', 'material_type_id'])) {
            $uri_zipper   = (new Zipper)->make(request()->file('uri'));
            $thumb_zipper = (new Zipper)->make(request()->file('thumb'));
            $uri_list     = array_map(function ($each) {
                preg_match('#(.+)\.#', $each, $match);

                return $match[1];
            }, $uri_zipper->listFiles());

            $thumb_list = array_map(function ($each) {
                preg_match('#(.+)\.#', $each, $match);

                return $match[1];
            }, $thumb_zipper->listFiles());

            if (empty(array_diff($uri_list, $thumb_list))) {
                // check success
                foreach (range(0, count($uri_list) - 1) as $index) {
                    $uri_filename   = 'images/' . md5(uniqid()) . '.jpg';
                    $thumb_filename = 'images/' . md5(uniqid()) . '.jpg';

                    Storage::disk('admin')->put($uri_filename, $uri_zipper->getFileContent($uri_zipper->listFiles()
                    [$index]));
                    Storage::disk('admin')->put($thumb_filename, $thumb_zipper->getFileContent($thumb_zipper->listFiles()
                    [$index]));

                    $material                   = new Material();
                    $material->uri              = $uri_filename;
                    $material->thumb            = $thumb_filename;
                    $material->material_type_id = request()->post('material_type_id');
                    $material->save();
                }
                $success = new MessageBag([
                    'message' => '提交成功',
                ]);

                return redirect()->route('materials.index')->with(compact('success'));
            }

            $error = new MessageBag([
                'message' => '文件名不匹配',
            ]);

            return redirect()->route('materials.index')->with(compact('error'));
        }
        $error = new MessageBag([
            'message' => '是不是忘了选素材分类了?',
        ]);

        return redirect()->route('materials.index')->with(compact('error'));
    }
}
