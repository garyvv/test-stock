<?php

namespace App\Http\Controllers\Stock;

use App\Models\StCategory;
use App\Models\StockSeller;
use App\Models\StockDepot;
use App\Models\StockCategory;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{

    public function index() {
        return view('Stock.index');
    }

    public function lists(){
        $cateLists = StCategory::getCateLists();
        return view('Stock.categoryList',compact('cateLists'));
    }

    public function detail($cid) {
        $detail = new StCategory();
        $detail = $detail->getCateDetail($cid);
        $detail->inventory = $detail->purchase_amount - $detail->selling_amount;//获取库存
        return view('Stock.categoryDetail',compact('detail'));
    }
    public function edit($cid) {
        $detail = new StCategory();
        $detail = $detail->getCateDetail($cid);
        $sellers = StCategory::getSellers();
        $depots = StCategory::getDepots();
        return view('Stock.categoryEdit',compact('detail','sellers','depots'));
    }

    public function update($categoryId){
        $this->requestValidate(
            [
                'name' => 'min:2',
            ],
            [
                'name.min' => 'name 字段最少2个字符',
            ]
        );

        $categoryInfo = StCategory::find($categoryId);

        if(!empty($categoryInfo)){//判断是否存在数据
            $categoryInfo->name = Input::get('name', $categoryInfo->name);
            $categoryInfo->seller_id = Input::get('seller_id', $categoryInfo->seller_id);
            $categoryInfo->depot_id = Input::get('depot_id', $categoryInfo->depot_id);
            $categoryInfo->wholesale_price = Input::get('wholesale_price', $categoryInfo->wholesale_price);
            $categoryInfo->retail_price = Input::get('retail_price', $categoryInfo->retail_price);
            $categoryInfo->purchasing_price = Input::get('purchasing_price', $categoryInfo->purchasing_price);
            $categoryInfo->vip_price = Input::get('vip_price', $categoryInfo->vip_price);
            $categoryInfo->option_name = Input::get('option_name', $categoryInfo->option_name);
            $update = $categoryInfo->save();

            $message = "success";
            return $this->respData($categoryInfo,$message);

        }else{
//            return redirect()->action('Stock\CategoryController@CateList');
            return $this->respFail('找不到分类');
        }
    }
}