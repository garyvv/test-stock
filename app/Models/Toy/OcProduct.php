<?php

namespace App\Models\Toy;

use App\Models\BaseModels;
use Illuminate\Support\Facades\DB;

class OcProduct extends BaseModels
{
    protected $table = 'oc_product';
    protected $primaryKey = "product_id";

    public $timestamps = false;

    public static $statusText = [
        self::STATUS_COMMON_OFFLINE => '下线',
        self::STATUS_COMMON_NORMAL => '上线',
    ];
}
