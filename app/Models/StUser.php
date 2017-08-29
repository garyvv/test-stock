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

class StUser extends Model
{
    protected $table = 'st_users';
    protected $primaryKey = 'uid';

    public function getUser($openid){
        return DB::table('st_users')
            ->select( 'uid' )
            ->where('openid',$openid)
            ->first();
    }
}