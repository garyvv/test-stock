<?php

namespace App\Models\Toy;

use App\Models\BaseModels;
use Illuminate\Support\Facades\DB;

class OcProductToCategory extends BaseModels
{
    protected $table = 'oc_product_to_category';
    protected $primaryKey = "product_id";

    public $timestamps = false;

}
