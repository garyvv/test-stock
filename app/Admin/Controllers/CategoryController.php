<?php

namespace App\Admin\Controllers;

use App\Models\StCategory;
use App\Models\StSeller;
use App\Models\StDepot;

use Zofe\Rapyd\DataEdit\DataEdit;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataFilter\DataFilter;

class CategoryController extends BaseController
{

    public function index()
    {

        $filter = DataFilter::source(StCategory::with('seller', 'depot'));
        $filter->link('admin/categories/edit', '新增', 'TR', ['class'=> 'btn btn-default-stock']);
        $filter->link('admin/categories?export=1', '导出', 'TR', ['class'=> 'btn btn-default-stock']);

        $filter->add('name', '商品类名', 'text');
        $filter->add('seller_id', '经销商', 'select')->options(StSeller::pluck("name", "seller_id")->toArray());
        $filter->add('depot_id', '仓库位置', 'select')->options(StDepot::pluck("name", "depot_id")->toArray());
        $filter->submit('筛选');
        $filter->reset('重置');
        $filter->build();

        $grid = DataGrid::source($filter);

        $grid->attributes(array("class"=>"table table-bordered table-striped table-hover"));
        $grid->add('category_id', 'ID', true)->style("width:100px");
        $grid->add('name', '商品类名');
        $grid->add('seller.name', '经销商');
        $grid->add('depot.name', '仓库位');
        $grid->add('wholesale_price', '批发售价', true);
        $grid->add('retail_price', '零售价格', true);
        $grid->add('purchasing_price', '入货价格', true);
        $grid->add('vip_price', '会员价格', true);
        $grid->add('total', '库存数量', true);
        $grid->add('total_in', '总进货', true);
        $grid->add('total_sale', '总销售', true);
        $grid->add('option_name', '规格');

        $grid->edit('/admin/categories/edit', '操作', 'show|modify|delete');
        $grid->orderBy('category_id', 'desc');
        $grid->paginate(self::DEFAULT_PER_PAGE);

        $title = '商品分类列表';
        if (Input::get('export') == 1) {
            return $grid->buildCSV($title,'Ymd');
        }
        return view('rapyd.filtergrid', compact('filter', 'grid', 'title'));
    }

    public function edit()
    {
        $edit = DataEdit::source(new StCategory());
        $edit->label('商品类信息');
        $edit->link("/admin/categories", "列表", "TR")->back();
        $edit->add('name', '商品类名', 'text')->rule('required|min:3');
        $edit->add('seller_id', '经销商', 'select')->options(StSeller::pluck("name", "seller_id")->toArray());
        $edit->add('depot_id', '仓库位置', 'select')->options(StDepot::pluck("name", "depot_id")->toArray());
        $edit->add('wholesale_price', '批发价', 'text');
        $edit->add('retail_price', '零售价', 'text');
        $edit->add('purchasing_price', '入货价', 'text');
        $edit->add('vip_price', '会员价', 'text');
        $edit->add('option_name', '规格', 'textarea')->attributes(array('rows' => 4));

        return $edit->view('rapyd.edit', compact('edit'));

    }
}
