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
use App\Http\Controllers\Controller;

class PurchaseRecordController extends Controller
{
    public function getLists()
    {
        $per_page = Input::get('per_page', 20);
        $PurchaseRecordLists = StPurchaseRecord::getLists($per_page)->toArray();
        return $this->respData($PurchaseRecordLists);
    }

    public function getDetail($pid)
    {
        $purchaseRecordDetail = new StPurchaseRecord();
        $purchaseRecordDetail = $purchaseRecordDetail->getDetail($pid);
        return $this->respData($purchaseRecordDetail);
    }
}