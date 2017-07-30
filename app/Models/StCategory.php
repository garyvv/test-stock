<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class StCategory extends Model
{
    protected $table = 'st_categories';
    protected $primaryKey = "category_id";

    public function seller()
    {
        return $this->hasOne('App\Models\StSeller', 'seller_id', 'seller_id');
    }

    public function depot()
    {
        return $this->hasOne('App\Models\StDepot', 'depot_id', 'depot_id');
    }

    public function purchase()
    {
        return $this->hasMany('App\Models\StPurchaseRecord', 'category_id', 'category_id');
    }

    public static function rapydGrid()
    {
        return DB::table('st_categories AS c')
            ->leftJoin('st_sellers AS s', 'c.seller_id', 's.seller_id')
            ->leftJoin('st_depots AS d', 'c.depot_id', 'd.depot_id')
            ->leftJoin('st_purchase_records AS pr', 'c.category_id', 'pr.category_id')
            ->select(
                'c.category_id',
                'c.name',
                's.name AS seller_name',
                'd.name AS depot_name',
                'c.wholesale_price',
                'c.retail_price',
                'c.purchasing_price',
                'c.vip_price',
                DB::raw('COUNT(pr.purchase_record_id) AS count_in'),
                DB::raw('sum(pr.total) AS sum_in'),
                'c.option_name'
            )
            ->groupBy('c.category_id');
    }

    public static function getCateLists(){
        return DB::table('st_categories AS c')
            ->leftJoin('st_depots AS d', 'c.depot_id', 'd.depot_id')
            ->select(
                'c.category_id',
                'c.name',
                'd.name AS depot_name',
                'c.retail_price',
                'c.option_name'
            )
            ->get();
    }
}
