<?php

namespace App\Http\Controllers\Stock;

use App\Models\StCategory;
use DB;
use Illuminate\Support\Facades\Redis;
use EasyWeChat\Foundation\Application;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{

    public function index()
    {
        $url = Input::get('url','/');
        $config = config('wechatstock');
        $config['oauth']['callback'] = '/api/callback?url='.$url;
        $user = json_decode(Redis::get('wechat_user'),true);

        // 未登录
        if (empty($user)) {
            $app = new Application($config);
            $oauth = $app->oauth;
            \Log::debug(2);
//            $_SESSION['target_url'] = 'api/callback';
            return $oauth->redirect();
        }
        // 已经登录过
        $info = $user['original'];//用户具体信息
        return view('Stock.index',compact('info'));
    }

    public function lists()
    {
        $page = Input::get('page') ? Input::get('page') : 1;
        return view('Stock.categoryList', compact('cateLists', 'page'));
    }

    public function detail($cid)
    {
        return view('Stock.categoryDetail', compact('cid'));
    }

    public function edit($cid)
    {
        return view('Stock.categoryEdit', compact('cid'));
    }

    public function getLists()
    {
        $per_page = Input::get('per_page');
        $cateLists = StCategory::getCateLists($per_page)->toArray();
        return $this->respData($cateLists);
    }

    public function getDetail($cid)
    {
        $cateDetail = new StCategory();
        $cateDetail = $cateDetail->getCateDetail($cid);
        $cateDetail->inventory = $cateDetail->purchase_amount - $cateDetail->selling_amount;//获取库存
//        $cateDetail = StCategory::getCateDetail($cid);
        return $this->respData($cateDetail);
    }

    public function cateEdit($cid){
        $detail = new StCategory();
        $detail = $detail->getCateDetail($cid);
        $detail->sellers = StCategory::getSellers();
        $detail->depots = StCategory::getDepots();
        return $this->respData($detail);
//        echo 1;
    }

    public function update($categoryId)
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

            $message = "success";
            return $this->respData($categoryInfo, $message);

        } else {
            return $this->respFail('找不到分类');
        }
    }
}