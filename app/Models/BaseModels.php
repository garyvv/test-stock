<?php
/**
 * Created by PhpStorm.
 * User: gary
 * Date: 2017/11/17
 * Time: 23:47
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModels extends Model
{
    const STATUS_COMMON_NORMAL = 1;
    const STATUS_COMMON_OFFLINE = 0;
    const STATUS_COMMON_DELETED = -1;
}