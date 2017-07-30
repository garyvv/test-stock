<?php

namespace App\Http\Controllers\Stock;

use App\Models\StCategory;
use App\Models\StockSeller;
use App\Models\StockDepot;
use App\Models\StockCategory;
use DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index() {
        return view('Stock.category');
    }

    public function CateList(){
//        new StCategory();
        $cateLists = StCategory::getCateLists();

//        echo '<pre>';
//        var_dump($cateLists);
//        exit;
        return view('Stock.categoryList',compact('cateLists'));
    }

    public function detail() {
        if($_POST){
            echo "success";
            exit;
        }
//        $userInfo = StockUser::all();
        return view('Stock.categoryDetail');
    }
    public function edit() {
//        $sellers = StockSeller::all();
//        $depots = StockDepot::all();
//        $depots = DB::table('st_depots');
//        echo '<pre>';
//        var_dump($sellers);
//        exit;
        if($_POST){
//            $id = $_POST['id'];
            $category = DB::table('st_categories')->where('id', $_POST['id'])->first();
            if(empty($category)){
                echo '<pre>';
                var_dump($_POST);
                exit;
                DB::table('st_categories')->insert(
                    ['name' => $_POST['name']]);
//                return redirect('/Stock/categoryEdit')->with('保存成功'); //
//                return redirect('/')->with('message');
//                echo 1;
//                exit;
            }else{
                echo '<pre>';
                var_dump($_POST);
                exit;
                DB::table('st_categories')
                    ->where('id', $_POST['id'])
                    ->update(['name' => $_POST['name']]);
//                return redirect('/')->with('message');
//                return redirect('/Stock/categoryEdit')->with('更新成功'); //

            }

        }
//        $userInfo = StockUser::all();
        return view('Stock.categoryEdit');
    }
}