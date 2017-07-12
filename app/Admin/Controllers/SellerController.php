<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

use App\Models\StSeller;

class SellerController extends Controller
{
    public function index()
    {
	$filter = \DataFilter::source(new StSeller());
        $filter->add('name','供销商名称', 'text');
        $filter->submit('筛选');
        $filter->reset('重置');
        $filter->build();

	$grid = \DataGrid::source($filter);

        $grid->add('seller_id','ID', true)->style("width:100px");
        $grid->add('name','名称');

        $grid->edit('/rapyd-demo/edit', 'Edit','show|modify');
        $grid->link('/rapyd-demo/edit',"New Article", "TR");
        $grid->orderBy('seller_id','desc');
        $grid->paginate(10);

	return  view('rapyd.filtergrid', compact('filter', 'grid'));
    }
}
