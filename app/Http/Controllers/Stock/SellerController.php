<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 23:18
 */

namespace App\Http\Controllers\Stock;

use Illuminate\Support\Facades\Input;
use App\Models\StSeller;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function getLists()
    {
        $per_page = Input::get('per_page', 20);
        $sellerLists = StSeller::getSellerLists($per_page)->toArray();
        return $this->respData($sellerLists);
    }

    public function getDetail($sid)
    {
        $sellerDetail = new StSeller();
        $sellerDetail = $sellerDetail->getSellerDetail($sid);
        return $this->respData($sellerDetail);
    }

    public function edit($sid)
    {
        $detail = new StSeller();
        $detail = $detail->getSellerDetail($sid);
        return $this->respData($detail);
    }

    public function update($sid)
    {
        $this->requestValidate(
            [
                'name' => 'min:2',
            ],
            [
                'name.min' => 'name 字段最少2个字符',
            ]
        );
        $sellerInfo = StSeller::find($sid);

        if (!empty($sellerInfo)) {//判断是否存在数据
            $sellerInfo->name = Input::get('name', $sellerInfo->name);
            $sellerInfo->contact = Input::get('contact', $sellerInfo->contact);
            $sellerInfo->address = Input::get('address', $sellerInfo->address);
            $sellerInfo->phone = Input::get('phone', $sellerInfo->phone);
            $sellerInfo->bank = Input::get('bank', $sellerInfo->bank);
            $sellerInfo->account = Input::get('account', $sellerInfo->account);
            $sellerInfo->save();

            $message = "success";
            return $this->respData($sellerInfo, $message);

        } else {
            return $this->respFail('找不到分类');
        }
    }
}