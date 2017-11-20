<?php
/**
 * Created by PhpStorm.
 * User: gary
 * Date: 2017/11/19
 * Time: 14:15
 */

namespace App\Admin\Controllers;


use App\Models\Toy\OcProduct;
use DiDom\Document;
use Garyvv\WebCreator\WeChatCreator;
use Illuminate\Support\Facades\Input;

class HtmlController extends BaseController
{
    public function editHtml()
    {
        $productId = Input::get('product_id', null);
        $link = Input::get('link', null);

        if ($link && strpos($link, 'http') !== false) {
            $html = new Document($link, true);
            $content = $html->find('body');
            $content = $content[0]->html();
        } else $content = '';

        $type = '';
        if ($productId) {
            $imageDir = 'products/';
            $type = 'product';
            $id = $productId;
        }

        return view('html', compact('content', 'id', 'imageDir', 'type'));
    }

    public function updateHtml()
    {
        $id = Input::get('id', null);
        $type = Input::get('type', null);
        $imageDir = Input::get('image_dir', null);
        $content = Input::get('content', null);

        $product = OcProduct::find($id);
        $header = [];
        if ($product){
            $commonHead = '-化州金利玩具店,玩具批发,儿童玩具,深冬工作室';
            $header = [
                'title' => $product->title . $commonHead,
                'description' => $product->title . $commonHead,
                'keywords' => $product->title . $commonHead,
            ];
        }

        $web = new WeChatCreator($content, $header);

        if ($type == 'product') {
            $path = 'toy/products/' . $id . '/';
            $dir = public_path($path);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $httpServer = env('HTTP_SERVER') . $path;
            $web->dealImage($dir, $httpServer, 'text');

//            传OSS
            $oss = config('oss');
            $oss['bucket'] = $oss['toy_bucket'];
            $oss['view_domain'] = $oss['toy_view_domain'];
            $oss['end_point'] = $oss['toy_end_point'];
            $oss['bucket_prefix'] = 'products/' . $id . '/';
            $web->setOss($oss);
            $web->uploadImageToOss();
            $web->uploadHtmlToOss('text.html');

            if ($product) {
                $product->content = $web->link;
                $product->save();
            }
        }


        return redirect('/admin/toy/products');
    }
}