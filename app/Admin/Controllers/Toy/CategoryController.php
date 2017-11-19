<?php

namespace App\Admin\Controllers\Toy;

use App\Admin\Controllers\BaseController;

use App\Models\Toy\OcCategory;
use Illuminate\Support\Facades\Input;
use Zofe\Rapyd\DataEdit\DataEdit;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataFilter\DataFilter;

class CategoryController extends BaseController
{

    public function index()
    {
        $filter = DataFilter::source(OcCategory::where('status', '!=', -1));
        $filter->link('admin/toy/categories/edit', '新增', 'TR', ['class'=> 'btn btn-default-stock']);
        $filter->link('admin/toy/categories?export=1', '导出', 'TR', ['class'=> 'btn btn-default-stock']);

        $filter->add('name', '分类名', 'text');
        $filter->submit('筛选');
        $filter->reset('重置');
        $filter->build();

        $grid = DataGrid::source($filter);

        $grid->attributes(array("class"=>"table table-bordered table-striped table-hover"));
        $grid->add('category_id', 'ID', true)->style("width:100px");
        $grid->add('name', '名称');
        $grid->add('image', '图标');
        $grid->add('parent_id', '父id', true);
        $grid->add('sort_order', '排序', true);
        $grid->add('status', '状态', true);
        $grid->edit('/admin/toy/categories/edit', '操作', 'show|modify|delete');
        $grid->orderBy('category_id', 'desc');
        $grid->paginate(self::DEFAULT_PER_PAGE);

        $title = '分类列表';
        if (Input::get('export') == 1) {
            return $grid->buildCSV($title,'Ymd');
        }
        return view('rapyd.filtergrid', compact('filter', 'grid', 'title'));
    }

    public function anyEdit()
    {
        $deleteId = Input::get('delete', null);
        if ($deleteId) {
            OcCategory::where('category_id', $deleteId)->update(['status' => -1]);
            return redirect('/admin/toy/categories');
        }

        $id = Input::get('modify', 0);
        if ($id) {
            $category = OcCategory::find($id);
            Input::offsetSet('parent_id', $category->parent_id);   // 选中
        }

        $edit = DataEdit::source(new OcCategory());
        $edit->label('分类信息');
        $edit->link("/admin/toy/categories", "列表", "TR")->back();
        $edit->add('name', '分类名称', 'text')
            ->rule('required|min:2')
            ->placeholder("请输入 分类名称");

        $edit->add('parent_id', '父标签', 'radiogroup')
            ->options(
                [0 => '小程序分类tab'] + OcCategory::where([
                        'parent_id' => 0,
                        'status' => OcCategory::STATUS_COMMON_NORMAL
                    ])->orderBy('sort_order', 'asc')->pluck('name', 'category_id')->toArray()
            );

        $edit->add('image', '封面图', 'text')
            ->attributes(['readOnly' => true]);

        $edit->add('sort_order', '排序', 'text')
            ->placeholder("请输入 排序")->insertValue(99);

        $edit->add('status', '状态', 'select')->options(OcCategory::$statusCommonText);

        $imageDir = 'categories/';
        return $edit->view('toy.category.edit', compact('edit', 'imageDir'));

    }
}
