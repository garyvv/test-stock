<?php

namespace App\Models\Toy;

use App\Models\BaseModels;
use Illuminate\Support\Facades\DB;

class OcCategory extends BaseModels
{
    protected $table = 'oc_category';
    protected $primaryKey = "category_id";

    public $timestamps = false;

}
