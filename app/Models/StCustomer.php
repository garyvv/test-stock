<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StCustomer extends Model
{
    protected $table = 'st_customers';
    protected $primaryKey = "customer_id";

    const GENDER_TEXT = [
        0 => '女',
        1 => '男'
    ];

}
