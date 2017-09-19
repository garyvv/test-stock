<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 23:18
 */

namespace App\Http\Controllers\Stock;

use Illuminate\Support\Facades\Input;
use App\Models\StPurchaseRecord;
use App\Http\Controllers\BaseController;

class PurchaseRecordController extends BaseController
{
    public function lists()
    {
        $per_page = Input::get('per_page', 20);
        $PurchaseRecordLists = StPurchaseRecord::getLists($per_page)->toArray();
        return $this->respData($PurchaseRecordLists);
    }

    public function detail($pid)
    {
        $purchaseRecordDetail = new StPurchaseRecord();
        $purchaseRecordDetail = $purchaseRecordDetail->getDetail($pid);
        return $this->respData($purchaseRecordDetail);
    }

    public function form()
    {
        $purchaseRecordDetail = new StPurchaseRecord();
//        $categorise = StPurchaseRecord::getCategorise();
        $purchaseRecordDetail->categorise = json_encode(StPurchaseRecord::getCategorise());
        return $this->respData($purchaseRecordDetail);
    }

    public function create(){
        $this->requestValidate(
            [
                'name' => 'min:2',
            ],
            [
                'name.min' => 'name 字段最少2个字符',
            ]
        );
        $purchaseRecord = new StPurchaseRecord();
        $purchaseRecord->category_id = Input::get('category_id');
        $purchaseRecord->quantity = Input::get('quantity');
        $purchaseRecord->total = Input::get('total');
        $purchaseRecord->freight = Input::get('freight');
        $purchaseRecord->purchase_time = Input::get('purchase_time');
        $purchaseRecord->comment = Input::get('comment');
        $purchaseRecord->save();
        $message = "添加成功";
        return $this->respData($message);
    }

    public function delete($pid){
        $purchaseRecord = St::find($pid);
        if (!empty($category)) {//判断是否存在数据
            $category->delete();
            $message = "删除成功";
            return $this->respData('',$message);
        }else {
            return $this->respFail('','找不到分类');
        }
    }
}