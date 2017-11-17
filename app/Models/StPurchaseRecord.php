<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StPurchaseRecord extends Model
{
    protected $table = 'st_purchase_records';
    protected $primaryKey = "purchase_record_id";

    public function category()
    {
        return $this->hasOne('App\Models\StCategory', 'category_id', 'category_id');
    }

    public static function rapydAllCategories()
    {
        return DB::table('st_purchase_records AS p')
            ->leftJoin('st_categories AS c', 'p.category_id', '=', 'c.category_id')
            ->select(
                DB::raw('distinct p.category_id'),
                'c.name'
            );

    }

    public static function getCategorise(){
        return DB::table('st_categories')
            ->select(
                'category_id',
                'name'
            )
            ->get();
    }

    public static function getLists($per_page)
    {
        return DB::table('st_purchase_records AS p')
            ->leftJoin('st_categories AS c','p.category_id','=','c.category_id')
            ->select(
                'p.*',
                'c.name'
            )
            ->orderby('purchase_record_id','desc')
            ->paginate($per_page);
    }

    public function getDetail($pid)
    {
        return DB::table('st_purchase_records AS p')
            ->leftJoin('st_categories AS c','p.category_id','=','c.category_id')
            ->select(
                'p.*',
                'c.name'
            )
            ->where('purchase_record_id',$pid)
            ->first();
    }
}
