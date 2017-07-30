<?php
/**
 * Created by PhpStorm.
 * User: gary
 * Date: 2017/3/14
 * Time: 上午12:26
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
class DemoController extends Controller
{
    public function index() {
    	$filter = \DataFilter::source(new Product());
        $filter->add('title','Title', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();

        $grid = \DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('title','Title', true);
        $grid->edit('/admin/anyEdit', 'Edit','modify|delete');
        $grid->paginate(10);

        return  view('product', compact('filter', 'grid'));
    }

    public function anyEdit() {
    	$edit = \DataEdit::source(new Product());
        $edit->label('编辑商品');
        $edit->link("admin/wenda","商品列表", "TR")->back();
        $edit->add('title','Title', 'text')->rule('required|min:5');

        $edit->add('body','Body', 'redactor');

        return view('defaultEdit', compact('edit'));
    }
}
