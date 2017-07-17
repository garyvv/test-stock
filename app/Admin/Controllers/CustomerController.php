<?php
namespace App\Admin\Controllers;
use App\Models\StCustomer;
use Illuminate\Support\Facades\Input;
use Zofe\Rapyd\DataEdit\DataEdit;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataFilter\DataFilter;
class CustomerController extends BaseController
{
    public function index()
    {
        $filter = DataFilter::source(new StCustomer());
        $filter->link('admin/customers/edit', '新增', 'TR', ['class'=> 'btn btn-default-stock']);
        $filter->link('admin/customers?export=1', '导出', 'TR', ['class'=> 'btn btn-default-stock']);

        $filter->add('name', '客户名', 'text');
        $filter->add('identifier', '客户编号', 'text');
        $filter->submit('筛选');
        $filter->reset('重置');
        $filter->build();

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-bordered table-striped table-hover"));
        $grid->add('customer_id', 'ID', true)->style("width:100px");
        $grid->add('name', '客户名');
        $grid->add('identifier', '客户编号');
        $grid->add('{{ ($gender == 1) ? "男":"女" }}', '性别');
        $grid->add('telephone', '联系电话');
        $grid->add('mobile', '手机号码');
        $grid->add('address', '地址');
        $grid->add('buy_times', '购买次数', true);
        $grid->add('total_buy', '消费总额', true);
        $grid->add('comment', '备注');
        $grid->edit('/admin/customers/edit', '操作', 'show|modify|delete');
        $grid->orderBy('customer_id', 'desc');
        $grid->paginate(self::DEFAULT_PER_PAGE);

        $title = '客户信息列表';
        if (Input::get('export') == 1) {
            return $grid->buildCSV($title,'Ymd');
        }
        return view('rapyd.filtergrid', compact('filter', 'grid', 'title'));
    }
    public function edit()
    {
        $edit = DataEdit::source(new StCustomer());
        $edit->label('客户信息');
        $edit->link("/admin/customers", "列表", "TR")->back();
        $edit->add('name', '客户名', 'text')->rule('required|min:2');;
        $edit->add('identifier', '客户编号', 'text');
//        $edit->add('avatar', '头像', 'image')->move('upload/customers/')->preview(80,80);
        $edit->add('gender', '性别', 'select')->options(StCustomer::GENDER_TEXT);
        $edit->add('telephone', '联系电话', 'number');
        $edit->add('mobile', '手机号码', 'number');
        $edit->add('address', '地址', 'textarea')->attributes(array('rows' => 2));
        $edit->add('buy_times', '购买次数', 'number');
        $edit->add('total_buy', '消费总额', 'text');
        $edit->add('comment', '备注', 'textarea')->attributes(array('rows' => 3));
        return $edit->view('rapyd.edit', compact('edit'));
    }
}