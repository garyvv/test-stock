<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StDepot extends Model
{
    protected $table = 'st_depots';
    protected $primaryKey = "depot_id";
    public $timestamps = false;

    public static function getDepotLists($per_page)
    {
        return DB::table('st_depots')
            ->select('*')
            ->paginate($per_page);
    }

    public function getDepotDetail($did)
    {
        return DB::table('st_depots')
            ->select('*')
            ->where('depot_id',$did)
            ->first();
    }
}
