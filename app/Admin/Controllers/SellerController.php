<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

use App\Models\StSeller;

use Zofe\Rapyd\DataEdit\DataEdit;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataFilter\DataFilter;

class SellerController extends Controller
{

    public function index()
    {
        $filter = DataFilter::source(new StSeller());
        $filter->add('name', '供销商名称', 'text');
        $filter->submit('筛选');
        $filter->reset('重置');
        $filter->link('admin/sellers/edit', '新增');
        $filter->build();

        $grid = DataGrid::source($filter);

        $grid->add('seller_id', 'ID', true)->style("width:100px");
        $grid->add('name', '名称');
        $grid->add('contact', '联系人');
        $grid->add('address', '地址');
        $grid->add('phone', '联系电话');
        $grid->add('bank', '开户银行');
        $grid->add('account', '银行账号');

        $grid->edit('/admin/sellers/edit', '操作', 'show|modify|delete');
//        $grid->link('/admin/sellers/edit',"新增", "TL");
        $grid->orderBy('seller_id', 'desc');
        $grid->paginate(10);

        return view('rapyd.filtergrid', compact('filter', 'grid'));
    }

    public function edit()
    {
        $edit = DataEdit::source(new StSeller());
        $edit->label('经销商信息');
        $edit->link("/admin/sellers", "列表", "TR")->back();
        $edit->add('name', '经销商名称', 'text')->rule('required|min:5');

        $edit->add('contact', '联系人', 'text');
        $edit->add('address', '地址', 'textarea')->attributes(array('rows' => 2));
        $edit->add('phone', '联系电话', 'text');
        $edit->add('bank', '开户银行', 'text');//->options(Author::lists("firstname", "id")->all());
        $edit->add('account', '开户账号', 'text');

        return $edit->view('rapyd.edit', compact('edit'));

    }
}
