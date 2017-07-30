<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{
    public function index() {
        if($_POST){
            echo "success";
            exit;
        }
//        $userInfo = StockUser::all();
        return view('Stock.center', compact('userInfo'));
    }
}