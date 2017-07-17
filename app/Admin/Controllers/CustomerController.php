<?php

namespace App\Admin\Controllers;

use App\Models\StCustomer;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;

class CustomerController extends BaseController
{

    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('客户列表');
            $content->description('客户的信息列表');

            $content->body($this->grid());
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('客户信息');
            $content->description('编辑客户信息');

            $content->body($this->form()->edit($id));
        });
    }

    protected function grid()
    {
        return Admin::grid(StCustomer::class, function (Grid $grid) {

            $grid->model()->orderBy('customer_id', 'DESC');

            $grid->customer_id('ID')->sortable();
            $grid->name('客户名');
            $grid->identifier('客户编号');
            $grid->gender('性别')->display(function ($gender) {
                return $gender == 1 ? '男' : '女';
            });
            $grid->telephone('联系电话');
            $grid->mobile('手机号码');
            $grid->address('地址');
            $grid->buy_times('购买次数')->sortable();
            $grid->total_buy('消费总额')->sortable();
            $grid->comment('备注');

            $grid->filter(function ($filter) {
//                $filter->useModal();  // 是否合并

                $filter->disableIdFilter();

                $filter->equal('identifier', '客户编号');
                $filter->like('name', '客户名');
            });


        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('客户信息');
            $content->description('新增客户信息');

            $content->body($this->form());
        });
    }

    protected function form()
    {
        return Admin::form(StCustomer::class, function (Form $form) {

            $form->text('name', '昵称');
            $form->image('avatar', '头像');
            $form->text('identifier', '客户编号');
            $form->radio('gender', '性别')->options(['0' => '女', '1' => '男'])->default('1');
            $form->mobile('telephone','固话')->options(['mask' => '9999-9999999']);
            $form->mobile('mobile','手机号码')->options(['mask' => '99999999999']);
            $form->text('address','地址');
            $form->textarea('comment','备注');
        });
    }
}
