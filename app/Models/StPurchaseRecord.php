<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StPurchaseRecord extends Model
{
    protected $table = 'st_purchase_records';
    protected $primaryKey = "purchase_record_id";

    public function category()
    {
        return $this->hasOne('App\Models\StCategory', 'category_id', 'category_id');
    }

}
