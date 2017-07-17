<?php

namespace App\Admin\Controllers;

use App\Models\StDepot;

use Zofe\Rapyd\DataEdit\DataEdit;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataFilter\DataFilter;

class DepotController extends BaseController
{

    public function index()
    {
        $filter = DataFilter::source(new StDepot());
        $filter->link('admin/depots/edit', '新增', 'TR', ['class'=> 'btn btn-default-stock']);
        $filter->link('admin/depots?export=1', '导出', 'TR', ['class'=> 'btn btn-default-stock']);

        $filter->add('name', '仓库名', 'text');
        $filter->submit('筛选');
        $filter->reset('重置');
        $filter->build();

        $grid = DataGrid::source($filter);

        $grid->attributes(array("class"=>"table table-bordered table-striped table-hover"));
        $grid->add('depot_id', 'ID', true)->style("width:100px");
        $grid->add('name', '名称');
        $grid->add('user_id', '管理员');
        $grid->edit('/admin/depots/edit', '操作', 'show|modify|delete');
        $grid->orderBy('depot_id', 'desc');
        $grid->paginate(self::DEFAULT_PER_PAGE);

        $title = '仓库信息列表';
        if (Input::get('export') == 1) {
            return $grid->buildCSV($title,'Ymd');
        }
        return view('rapyd.filtergrid', compact('filter', 'grid', 'title'));
    }

    public function edit()
    {
        $edit = DataEdit::source(new StDepot());
        $edit->label('仓库信息');
        $edit->link("/admin/depots", "列表", "TR")->back();
        $edit->add('name', '仓库名称', 'text')->rule('required|min:5');

        $edit->add('user_id', '管理员', 'select')->options(['无', 'AAA', 'BBB']);

        return $edit->view('rapyd.edit', compact('edit'));

    }
}
