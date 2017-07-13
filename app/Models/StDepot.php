<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StDepot extends Model
{
    protected $table = 'st_depots';
    protected $primaryKey="depot_id";
    public $timestamps = false;
}
