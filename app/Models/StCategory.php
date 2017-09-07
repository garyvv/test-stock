<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


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

    public static function getCateLists($per_page){
        return DB::table('st_categories AS c')
            ->leftJoin('st_depots AS d', 'c.depot_id', 'd.depot_id')
            ->select(
                'c.category_id',
                'c.name',
                'd.name AS depot_name',
                'c.retail_price',
                'c.option_name'
            )
            ->orderby('c.category_id','desc')
            ->paginate($per_page);
    }

    public function getCateDetail($cid){
        return DB::table('st_categories AS c')
            ->leftJoin('st_purchase_records AS pr', 'c.category_id', 'pr.category_id')
            ->leftJoin('st_depots AS d', 'c.depot_id', 'd.depot_id')
            ->leftJoin('st_orders AS o', 'c.category_id', 'o.category_id')
            ->leftJoin('st_sellers AS s', 'c.seller_id', 's.seller_id')
            ->select(
                'c.category_id',
                'c.seller_id',
                'c.depot_id',
                'c.name',
                'c.option_name',
                'c.purchasing_price',
                'c.wholesale_price',
                'c.retail_price',
                'c.vip_price',
                'pr.quantity',
                's.name AS seller_name',
                'd.name AS depot_name',
                's.address',
                's.contact',
                'phone',
                DB::raw('sum(pr.quantity) AS purchase_amount'),
                DB::raw('sum(o.quantity) AS selling_amount')
            )
            ->where('c.category_id',$cid)
            ->groupBy('c.category_id')
            ->first();
    }

    public function getCateInfo($cid){
        return DB::table('st_categories')
            ->select(
                'category_id',
                'name'
            )
            ->where('category_id',$cid)
            ->first();
    }
    public static function getSellers(){
        return DB::table('st_sellers')
            ->select(
                'seller_id',
                'name'
            )
            ->get();
    }
    public static function getDepots(){
        return DB::table('st_depots')
            ->select(
                'depot_id',
                'name'
            )
            ->get();
    }
}
