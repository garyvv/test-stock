<?php

namespace App\Http\Controllers\LeaseStore;

use App\Http\Controllers\Controller;
use App\Models\WesProduct;

class ProductController extends Controller
{
    public function detail($product_id) {
	$product = WesProduct::find($product_id);
	return view('LeaseStore.product', compact('product'));
    }

}
