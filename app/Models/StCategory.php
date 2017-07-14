<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


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
}
