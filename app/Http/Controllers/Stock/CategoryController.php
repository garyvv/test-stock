<?php

namespace App\Http\Controllers\Stock;

use App\Models\StCategory;
use DB;
use Symfony\Component\HttpFoundation\Request;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Input;


class CategoryController extends BaseController
{
    public function login()
    {
        $this->requestValidate([
            'url' => 'required',
        ], [
            'url.required' => '登录成功跳转链接不能为空',
        ]);
        $config = config('wechatstock');
        $url = '?url=' . urlencode(Input::get('url'));
        $config['oauth']['callback'] = '/api/callback'.$url;
        $app = new Application($config);
        $oauth = $app->oauth;
        return $oauth->redirect();
    }

    public function getUserInfo(Request $request)
    {

        $token = $request->header('token',null);
        \Log::debug("userToken:".$token);
        $info = $this->userInfo;
        \Log::debug("userInfo:");
        \Log::debug($info);
        return $this->respData($info);
    }

    public function getLists()
    {
        $this->checkToken();
        $per_page = Input::get('per_page');
        $cateLists = StCategory::getCateLists($per_page)->toArray();
        return $this->respData($cateLists);
    }

    public function getDetail($cid)
    {
        $this->checkToken();

        $cateDetail = new StCategory();
        $cateDetail = $cateDetail->getCateDetail($cid);
        $cateDetail->inventory = $cateDetail->purchase_amount - $cateDetail->selling_amount;//获取库存
//        $cateDetail = StCategory::getCateDetail($cid);
        return $this->respData($cateDetail);
    }

    public function cateEdit($cid){
        $this->checkToken();

        $detail = new StCategory();
        $detail = $detail->getCateDetail($cid);
        $detail->sellers = StCategory::getSellers();
        $detail->depots = StCategory::getDepots();
        return $this->respData($detail);
    }

    public function update($categoryId)
    {
        $this->checkToken();

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

            $message = "success";
            return $this->respData($categoryInfo, $message);

        } else {
            return $this->respFail('找不到分类');
        }
    }
}