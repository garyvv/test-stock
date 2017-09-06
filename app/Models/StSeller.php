<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StSeller extends Model
{
    protected $table = 'st_sellers';
    protected $primaryKey = "seller_id";

    public static function getSellerLists($per_page){
        return DB::table('st_sellers')
            ->select(
                'seller_id',
                'name',
                'contact',
                'phone',
                'address'
            )
            ->paginate($per_page);
    }

    public function getSellerDetail($sid)
    {
        return DB::table('st_sellers')
            ->select('*')
            ->where('seller_id',$sid)
            ->first();
    }

}
