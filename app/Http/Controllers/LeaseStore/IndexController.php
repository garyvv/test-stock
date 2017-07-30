<?php

namespace App\Http\Controllers\LeaseStore;

use App\Http\Controllers\Controller;
use App\Models\WesProduct;

class IndexController extends Controller
{
    public function index() {
    	$products = WesProduct::all();
	return view('LeaseStore.index', compact('products'));
    }
}
