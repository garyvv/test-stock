<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StSeller extends Model
{
    protected $table = 'st_sellers';
    protected $primaryKey = "seller_id";

    public static function lists($per_page){
        return DB::table('st_sellers')
            ->select(
                'seller_id',
                'name',
                'contact',
                'phone',
                'address'
            )
            ->orderby('seller_id','desc')
            ->paginate($per_page);
    }

    public function detail($sid)
    {
        return DB::table('st_sellers')
            ->select('*')
            ->where('seller_id',$sid)
            ->first();
    }

}
