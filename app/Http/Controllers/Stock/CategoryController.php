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
        return view('Stock.category');
    }

    public function CateList(){

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
}