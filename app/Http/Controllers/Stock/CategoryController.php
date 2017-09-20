<?php

namespace App\Http\Controllers\Stock;

use App\Models\StCategory;
use DB;
use Illuminate\Support\Facades\Input;


class CategoryController extends BaseController
{

    public function lists()
    {
        $per_page = Input::get('per_page', 20);
        $cateLists = StCategory::lists($per_page)->toArray();
        return $this->respData($cateLists);
    }

    public function detail($cid)
    {
        $cateDetail = new StCategory();
        $cateDetail = $cateDetail->detail($cid);
        $cateDetail->inventory = $cateDetail->purchase_amount - $cateDetail->selling_amount;//获取库存
//        $cateDetail = StCategory::getCateDetail($cid);
        return $this->respData($cateDetail);
    }

    public function form($cid = '')
    {
        $form = new StCategory();
        if(!empty($cid)){
            $form = $form->detail($cid);
        }
        $form->sellers = StCategory::sellers();
        $form->depots = StCategory::depots();
        return $this->respData($form);
    }

    public function create()
    {
        $this->requestValidate(
            [
                'name' => 'min:2',
            ],
            [
                'name.min' => 'name 字段最少2个字符',
            ]
        );
        $categoryInfo = new StCategory();
        $categoryInfo->name = Input::get('name');
        $categoryInfo->seller_id = Input::get('seller_id');
        $categoryInfo->depot_id = Input::get('depot_id');
        $categoryInfo->wholesale_price = Input::get('wholesale_price');
        $categoryInfo->retail_price = Input::get('retail_price');
        $categoryInfo->purchasing_price = Input::get('purchasing_price');
        $categoryInfo->vip_price = Input::get('vip_price');
        $categoryInfo->option_name = Input::get('option_name');
        $categoryInfo->save();
        $message = "添加成功";
        return $this->respData($message);
    }

    public function edit($categoryId)
    {
        $this->requestValidate(
            [
                'name' => 'min:2',
            ],
            [
                'name.min' => 'name 字段最少2个字符',
            ]
        );
        $categoryInfo = StCategory::find($categoryId);

        if (!empty($categoryInfo)) {//判断是否存在数据
            $categoryInfo->name = Input::get('name', $categoryInfo->name);
            $categoryInfo->seller_id = Input::get('seller_id', $categoryInfo->seller_id);
            $categoryInfo->depot_id = Input::get('depot_id', $categoryInfo->depot_id);
            $categoryInfo->wholesale_price = Input::get('wholesale_price', $categoryInfo->wholesale_price);
            $categoryInfo->retail_price = Input::get('retail_price', $categoryInfo->retail_price);
            $categoryInfo->purchasing_price = Input::get('purchasing_price', $categoryInfo->purchasing_price);
            $categoryInfo->vip_price = Input::get('vip_price', $categoryInfo->vip_price);
            $categoryInfo->option_name = Input::get('option_name', $categoryInfo->option_name);
            $categoryInfo->save();

            $message = "修改成功";
            return $this->respData($categoryInfo, $message);

        } else {
            return $this->respFail('找不到分类');
        }
    }

    public function delete($cid)
    {
        $category = StCategory::find($cid);
        if (!empty($category)) {//判断是否存在数据
            $category->delete();
            $message = "删除成功";
            return $this->respData('',$message);
        }else {
            return $this->respFail('','找不到分类');
        }
    }
}