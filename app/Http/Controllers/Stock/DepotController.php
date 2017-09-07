<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 23:18
 */

namespace App\Http\Controllers\Stock;

use Illuminate\Support\Facades\Input;
use App\Models\StDepot;
use App\Http\Controllers\Controller;

class DepotController extends Controller
{
    public function getLists()
    {
        $per_page = Input::get('per_page', 20);
        $DepotLists = StDepot::getDepotLists($per_page)->toArray();
        return $this->respData($DepotLists);
    }

    public function getDetail($did)
    {
        $depotDetail = new StDepot();
        $depotDetail = $depotDetail->getDepotDetail($did);
        return $this->respData($depotDetail);
    }

    public function create()
    {
        $depot = new StDepot();
        $depot->name = Input::get('name');
        $depot->save();
        $message = "添加成功";
        return $this->respData('',$message);
    }

    public function getForm($did)
    {
        $detail = new StDepot();
        $detail = $detail->getDepotDetail($did);
        return $this->respData($detail);
    }

    public function delete($did)
    {
        $depot =  StDepot::find($did);
        \Log::debug("did:".$did);
        if(!empty($depot)){
            $depot->delete();
            $message = "删除成功";
            return $this->respData('',$message);
        }else{
            $message = "找不到该条信息，请刷新后重试";
            return $this->respFail('',$message);
        }
    }

    public function update($did)
    {
        $this->requestValidate(
            [
                'name' => 'min:2',
            ],
            [
                'name.min' => 'name 字段最少2个字符',
            ]
        );
        $depotInfo = StDepot::find($did);

        if (!empty($depotInfo)) {//判断是否存在数据
            $depotInfo->name = Input::get('name', $depotInfo->name);
            $depotInfo->save();

            $message = "success";
            return $this->respData($depotInfo, $message);

        } else {
            return $this->respFail('找不到分类');
        }
    }
}