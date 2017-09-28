<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/25
 * Time: 1:19
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StUserGroup extends Model
{
    protected $table = 'st_user_groups';
    protected $primaryKey = 'user_group_id';

}