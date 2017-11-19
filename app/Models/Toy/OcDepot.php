<?php

namespace App\Models\Toy;

use App\Models\BaseModels;
use Illuminate\Support\Facades\DB;

class OcDepot extends BaseModels
{
    protected $table = 'oc_depots';
    protected $primaryKey = "depot_id";
    public $timestamps = false;

}
