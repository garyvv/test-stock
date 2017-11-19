<?php

namespace App\Models\Toy;

use App\Models\BaseModels;
use Illuminate\Support\Facades\DB;

class OcProductImage extends BaseModels
{
    protected $table = 'oc_product_image';
    protected $primaryKey = "product_image_id";

    public $timestamps = false;

}
