<?php

namespace App\Admin\Controllers;

use App\Models\StUser;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
//use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends BaseController
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('用户列表');
            $content->description('用户列表');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(StUser::class, function (Grid $grid) {

            $grid->uid('ID')->sortable();
            $grid->headimgurl('头像')->image('','60');
            $grid->nickname('昵称');
            $grid->sex('性别');
            $grid->user_group_id('用户组');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(StUser::class, function (Form $form) {

            $form->display('uid', 'ID');
            $form->image('headimgurl','头像');
            $form->text('nickname','昵称');
            $form->display('sex','性别');
            $form->text('user_group_id','用户组');
        });
    }
}
