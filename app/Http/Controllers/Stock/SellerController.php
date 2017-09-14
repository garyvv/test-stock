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
    public function lists()
    {
        $per_page = Input::get('per_page', 20);
        $sellerLists = StSeller::lists($per_page)->toArray();
        return $this->respData($sellerLists);
    }

    public function form($sid)
    {
        $detail = new StSeller();
        $detail = $detail->detail($sid);
        return $this->respData($detail);
    }

    public function detail($sid)
    {
        $sellerDetail = new StSeller();
        $sellerDetail = $sellerDetail->detail($sid);
        return $this->respData($sellerDetail);
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
        $seller = new StSeller();
        $seller->name = Input::get('name');
        $seller->contact = Input::get('contact');
        $seller->address = Input::get('address');
        $seller->phone = Input::get('phone');
        $seller->bank = Input::get('bank');
        $seller->account = Input::get('account');
        $seller->save();
        $message = "添加成功";
        return $this->respData($message);
    }

    public function edit($sid)
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
    public function delete($sid)
    {
        $seller = StSeller::find($sid);
        if (!empty($seller)) {//判断是否存在数据
            $seller->delete();
            $message = "删除成功";
            return $this->respData('',$message);
        }else {
            return $this->respFail('','找不到分类');
        }
    }

}