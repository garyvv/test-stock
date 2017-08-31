<?php

namespace App\Admin\Controllers;

use App\Models\VkStory;

use Illuminate\Support\Facades\Input;
use Zofe\Rapyd\DataEdit\DataEdit;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataFilter\DataFilter;

class VickyController extends BaseController
{

    public function index()
    {
        $filter = DataFilter::source(new VkStory());
        $filter->link('admin/vicky/story/edit', '新增', 'TR', ['class'=> 'btn btn-default-stock']);
        $filter->link('admin/vicky/story?export=1', '导出', 'TR', ['class'=> 'btn btn-default-stock']);

        $filter->add('content', '内容', 'text');
        $filter->add('datetime', '日期', 'daterange')
            ->format('Y-m-d', 'zh-CN');
        $filter->submit('筛选');
        $filter->reset('重置');
        $filter->build();

        $grid = DataGrid::source($filter);

        $grid->attributes(array("class"=>"table table-bordered table-striped table-hover"));
        $grid->add('id', 'ID', true)->style("width:100px");
        $grid->add('content', '内容');
        $grid->add('datetime', '日期');
        $grid->add('image', '图片');
        $grid->edit('/admin/vicky/story/edit', '操作', 'show|modify|delete');
        $grid->orderBy('datetime', 'desc');
        $grid->paginate(self::DEFAULT_PER_PAGE);

        $title = '故事列表';
        if (Input::get('export') == 1) {
            return $grid->buildCSV($title,'Ymd');
        }
        return view('rapyd.filtergrid', compact('filter', 'grid', 'title'));
    }

    public function edit()
    {
        $edit = DataEdit::source(new VkStory());
        $edit->label('故事信息');
        $edit->link("/admin/vicky/story", "列表", "TR")->back();
        $edit->add('content', '内容', 'text')->rule('required|min:5');
        $edit->add('datetime', '时间', 'date')->format('Y-m-d', 'zh-CN');
        $edit->add('image', '图片', 'image')->move('vicky/img/story/')->preview(80, 80);

        return $edit->view('rapyd.edit', compact('edit'));

    }
}
