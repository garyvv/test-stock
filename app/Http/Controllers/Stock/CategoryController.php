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

    public function update(){

        $this->requestValidate(
            [
                'name' => 'required|min:2|max:10',
            ],
            [
                'name.required' => 'name 字段不能为空',
                'name.min' => 'name 字段最少2个字符',
                'name.max' => 'name 字段最大10个字符',
            ]
        );

        $data = Input::all();
        $cid = $data['category_id'];
        $cateInfo = new StCategory();
        $cateInfo = $cateInfo->getCateInfo($cid);

        if(isset($cateInfo)){//判断是否存在数据
            $data = array(
                'category_id'=>$data['category_id'],
                'name'=>$data['name'],
                'seller_id'=>$data['seller_id'],
                'depot_id'=>$data['depot_id'],
                'wholesale_price'=>$data['wholesale_price'],
                'retail_price'=>$data['retail_price'],
                'purchasing_price'=>$data['purchasing_price'],
                'vip_price'=>$data['vip_price'],
                'option_name'=>$data['option_name'],
            );
            $update = DB::table('st_categories')
                        ->where('category_id',$cid)
                        ->update($data);
            if(!empty($update)){//判断是否有执行更新
                session(['message'=>'success']);
//                return redirect()->action('Stock\CategoryController@detail',$cid);
                $message = "success";
                return json_encode($message);
            }else{
                session(['message'=>'undo']);
//                return redirect()->action('Stock\CategoryController@detail',$cid);
                $message = "undo";
                return json_encode($message);
            }
        }else{
            session(['message'=>'fail']);
//            return redirect()->action('Stock\CategoryController@CateList');
            $message = "fail";
            return json_encode($message);
        }
    }
}