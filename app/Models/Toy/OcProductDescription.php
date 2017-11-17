<?php

namespace App\Models\Toy;

use App\Models\BaseModels;
use Illuminate\Support\Facades\DB;

class OcProductDescription extends BaseModels
{
    protected $table = 'oc_product_description';
    protected $primaryKey = "product_id";

    public $timestamps = false;

    const LANG_ID = 2;

    public static $statusText = [
        self::STATUS_COMMON_OFFLINE => '下线',
        self::STATUS_COMMON_NORMAL => '上线',
    ];
}
