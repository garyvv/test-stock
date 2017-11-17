<?php

namespace App\Admin\Controllers\JinLi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\JinLi\WxBanner;
use Zofe\Rapyd\DataEdit\DataEdit;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataFilter\DataFilter;

class BannerController extends Controller
{

    public function index()
    {
        $filter = DataFilter::source(new WxBanner());
        $filter->link('admin/jinli/banners/edit', '新增', 'TR', ['class'=> 'btn btn-default-stock']);
        $filter->link('admin/jinli/banners?export=1', '导出', 'TR', ['class'=> 'btn btn-default-stock']);

        $filter->add('title', 'Banner名称', 'text');
        $filter->submit('筛选');
        $filter->reset('重置');
        $filter->build();

        $grid = DataGrid::source($filter);

        $grid->attributes(array("class"=>"table table-bordered table-striped table-hover"));
        $grid->add('id', 'ID', true)->style("width:100px");
        $grid->add('title', '名称');
        $grid->edit('/admin/jinli/banners/edit', '操作', 'show|modify|delete');
        $grid->orderBy('id', 'desc');
        $grid->paginate(self::DEFAULT_PER_PAGE);

        $title = 'Banner信息列表';
        if (Input::get('export') == 1) {
            return $grid->buildCSV($title,'Ymd');
        }
        return view('rapyd.filtergrid', compact('filter', 'grid', 'title'));
    }

    public function edit()
    {
        $edit = DataEdit::source(new WxBanner());
        $edit->label('Banner信息');
        $edit->link("/admin/jinli/banners", "列表", "TR")->back();
        $edit->add('name', 'Banner名称', 'text')->rule('required|min:5');

        return $edit->view('rapyd.edit', compact('edit'));

    }
}
