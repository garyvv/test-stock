<?php

namespace App\Admin\Controllers\Toy;

use App\Admin\Controllers\BaseController;
use App\Models\Toy\OcCategory;
use App\Models\Toy\OcDepot;
use App\Models\Toy\OcProduct;
use App\Models\Toy\OcProductDescription;
use App\Models\Toy\OcProductImage;
use App\Models\Toy\OcProductToCategory;
use Encore\Admin\Facades\Admin;
use Garyvv\WebCreator\TmallCreator;
use Garyvv\WebCreator\WeChatCreator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Zofe\Rapyd\DataEdit\DataEdit;
use Zofe\Rapyd\DataForm\DataForm;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataFilter\DataFilter;
use Zofe\Rapyd\Url;

class ProductController extends BaseController
{

    public function index()
    {

        $title = '商品管理';
        $filter = DataFilter::source(OcProduct::where('status', '!=', -1));

        $filter->add('title', '标题', 'text');
        $filter->add('status', '状态', 'select')->options(['' => '全部状态'] + OcProduct::$statusText);
        $filter->add('date_added', '创建日期', 'daterange')
            ->format('Y-m-d', 'zh-CN');

        $filter->submit('筛选');
        $filter->reset('重置');
        $filter->build();

        $grid = DataGrid::source($filter);

        $grid->attributes(array("class" => "table table-bordered table-striped table-hover"));
        $grid->add('product_id', 'ID', true);
        $grid->add('title', '标题', false);
        $grid->add('bar_code', '条形码', true);
        $grid->add('image', '封面图', true);
        $grid->add('price', '零售价', true);
        $grid->add('sale_price', '批发价', true);
        $grid->add('vip_price', '会员价', true);
        $grid->add('in_price', '入货价', true);
        $grid->add('quantity', '库存', true);
        $grid->add('total_sale', '销量', true);
        $grid->add('status', '状态', true);
        $grid->add('depot_id', '仓库位', true);
        $grid->add('date_added', '创建日期', true);

        $grid->add('operation','操作', false);

        $grid->orderBy('date_added', 'desc');

        $url = new Url();
        $grid->link($url->append('export', 1)->get(), "导出Excel", "TR", ['class' => 'btn btn-export', 'target' => '_blank']);
        $grid->link(config('admin.prefix') . '/toy/products/create', '新增', 'TR', ['class' => 'btn btn-default']);

        $grid->row(function ($row) {
            $row->cell('status')->value = isset(OcProduct::$statusText[$row->data->status]) ? OcProduct::$statusText[$row->data->status] : '删除';

            ($row->data->status == OcProduct::STATUS_COMMON_NORMAL) && $row->cell('status')->style("color: #333333;");
            ($row->data->status == OcProduct::STATUS_COMMON_OFFLINE) && $row->cell('status')->style("color: #CECECE;");

//            skin: 'layui-layer-rim', //加上边框
//            shadeClose: true,   //点击遮罩关闭
            if ($row->data->content) $link = $row->data->content;
            else $link = '';

            $btnEditHtml = "btn: ['编辑'],btn1: function(index, layero){
                                //按钮【按钮一】的回调
                                window.location.href = '/" . config('admin.prefix') . "/html?product_id=" . $row->data->product_id . "&link=" . $link . "';
                                //return false; //开启该代码可禁止点击该按钮关闭
                             },";
            $link .= '?new=' . date('YmdHis');
            $contentType = 2; //layer content类型

            $btnPreview = "<button class=\"btn btn-primary\" onclick=\"layer.open({
                                                                                type: " . $contentType . ", 
                                                                                title: ['" . $row->data->title . "', false], 
                                                                                area: ['375px', '667px'], 
                                                                                " . $btnEditHtml . "
                                                                                shadeClose: true,
                                                                                scrollbar: false,
                                                                                content: '" . $link . "'
                                                                            })\">商品详情</button>";
            $btnEdit = "<a class='btn btn-default' href='/" . config('admin.prefix') . "/toy/products/edit?modify=" . $row->data->product_id . "'>编辑</a>";
            $btnDelete = '<button class="btn btn-danger" onclick="layer.confirm( \'确定删除吗？！\',{ btn: [\'确定\',\'取消\'] }, function(){ window.location.href = \'/' . config('admin.prefix') . "/toy/products/edit?delete=" . $row->data->product_id . '\'})">删除</button>';

            $row->cell('operation')->value = $btnPreview . $btnEdit . $btnDelete;


            $iamge = '<img style="height: 40px; width: auto; max-width: 60px; border-radius: 5px" src="' . $row->data->image . '" />&nbsp;';
            $row->cell('image')->value = $iamge;
        });

        if (Input::get('export') == 1) {
            $grid->build();
            return $grid->buildCSV($title, 'Ymd');
        } else {
            $grid->paginate(self::DEFAULT_PER_PAGE);
            $grid->build();
            return view('rapyd.filtergrid', compact('filter', 'grid', 'title'));
        }

    }


    public function anyForm()
    {

        $form = DataForm::source(new OcProduct());

        $form->label('商品信息');
        $form->link(config('admin.prefix') . "/toy/products", "列表", "TR")->back();

        $form->add('title', '标题', 'text')
            ->rule("required|min:2")
            ->placeholder("请输入 标题");

        $form->add('bar_code', '条形码', 'text')
            ->rule("required")
            ->placeholder("请输入 条形码，小程序扫码识别的条形码");

        $form->add('price', '零售价', 'text')
            ->rule("required")
            ->placeholder("请输入 零售价");

        $form->add('sale_price', '批发价', 'text')
            ->rule("required")
            ->placeholder("请输入 批发价");

        $form->add('vip_price', '会员价', 'text')
            ->rule("required")
            ->placeholder("请输入 入货价");

        $form->add('in_price', '入货价', 'text')
            ->rule("required")
            ->placeholder("请输入 入货价");

        $form->add('quantity', '库存', 'text')
            ->rule("required")
            ->placeholder("请输入 库存");

        $form->add('total_sale', '销量', 'text')
            ->rule("required")
            ->placeholder("请输入 销量");

        $form->add('sort_order', '排序', 'text')->insertValue(99);

        $form->add('viewed', '浏览数', 'text')->insertValue(rand(10,100));

        $form->add('textbox','内容','textarea')->rule("required")->attributes(['rows' => 15]);

        $form->add('image', '封面图', 'text')
            ->attributes(['readOnly' => true]);

//        $form->add('images', '相册', 'text')
//            ->attributes(['readOnly' => true]);

        $form->add('categories', '分类', 'checkboxgroup')
            ->options(OcCategory::where([
                'status' => OcCategory::STATUS_COMMON_NORMAL,
            ])->orderBy('sort_order', 'asc')->pluck('name', 'category_id'));

        $form->add('depot_id', '仓库', 'radiogroup')
            ->options(OcDepot::orderBy('sort_order', 'asc')->pluck('name', 'depot_id'));

        $form->add('status', '状态', 'select')->options(OcProduct::$statusText);

        $form->add('date_added', 'date', 'hidden')->insertValue(date('Y-m-d H:i:s'));

        $form->saved(function () use ($form) {
            $productId = $form->model->product_id;
            $product = OcProduct::find($productId);
            $product->model = $form->model->title;
            try{
                $images = [];// 使用富文本框内的图片
                if (Input::get('textbox', null)) {
                    $commonHead = '-化州金利玩具店,玩具批发,儿童玩具,深冬工作室';
                    $header = [
                        'title' => $form->model->title . $commonHead,
                        'description' => $form->model->title . $commonHead,
                        'keywords' => $form->model->title . $commonHead,
                    ];
                    $web = new TmallCreator(Input::get('textbox'), $header);
                    $path = 'toy/products/' . $productId . '/';
                    $dir = public_path($path);
                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                    }
                    $httpServer = env('HTTP_SERVER') . $path;

//                   传OSS
                    $oss = config('oss');
                    $oss['bucket'] = $oss['toy_bucket'];
                    $oss['view_domain'] = $oss['toy_view_domain'];
                    $oss['end_point'] = $oss['toy_end_point'];
                    $oss['bucket_prefix'] = 'products/' . $productId . '/';
                    $web->setOss($oss);

                    $web->dealImage($dir, $httpServer, 'text');

                    $web->uploadImageToOss();
                    $web->uploadHtmlToOss('text.html');

                    $product->content = $web->link;
                    $images = array_column($web->images, 'url');
                }

                $product->save();

                $product->images = $images;
                $this->saveProduct($product);

                $form->message("新建商品成功");
                $form->link(config('admin.prefix') . '/toy/products',"返回");
            } catch (\Exception $exception) {
                $product->save();
                $form->message('** <h3>【ERROR】</h3>下载外链图片错误 **：' . $exception->getMessage());
                $form->link(config('admin.prefix') . '/html?product_id=' . $form->model->product_id,"重新编辑HTML");
            }
        });

        $form->submit('保存');

        $imageDir = 'products/';
        return $form->view('toy.product.form', compact('form', 'imageDir'));
    }


    public function anyEdit()
    {
        $imageDir = 'products/';

        $deleteId = Input::get('delete', null);
        if ($deleteId) {
            OcProduct::where('product_id', $deleteId)->update(['status' => -1]);
            return redirect('/admin/toy/products');
        }

        $id = Input::get('modify', 0);
        $imageData = OcProductImage::where('product_id', $id)->orderBy('sort_order', 'DESC')->get()->toArray();
        $images = $imageData ? array_column($imageData, 'image') : [];
        if ($id) {
            $categoryList = OcProductToCategory::where('product_id', $id)->get()->toArray();
            $categories = array_column($categoryList, 'category_id');
            Input::offsetSet('categories', array_values($categories));   // 选中分类

            $imageDir = 'products/' . $id . '/'; //编辑则在该商品的文件夹下
        }

        $edit = DataEdit::source(new OcProduct());

        $edit->label('商品信息');
        $edit->link(config('admin.prefix') . "/toy/products", "列表", "TR")->back();

        $edit->add('title', '标题', 'text')
            ->rule("required|min:2")
            ->placeholder("请输入 标题");

        $edit->add('bar_code', '条形码', 'text')
            ->rule("required")
            ->placeholder("请输入 条形码，小程序扫码识别的条形码");

        $edit->add('price', '零售价', 'text')
            ->rule("required")
            ->placeholder("请输入 零售价");

        $edit->add('sale_price', '批发价', 'text')
            ->rule("required")
            ->placeholder("请输入 批发价");

        $edit->add('vip_price', '会员价', 'text')
            ->rule("required")
            ->placeholder("请输入 会员价");

        $edit->add('in_price', '入货价', 'text')
            ->rule("required")
            ->placeholder("请输入 入货价");

        $edit->add('quantity', '库存', 'text')
            ->rule("required")
            ->placeholder("请输入 库存");

        $edit->add('total_sale', '销量', 'text')
            ->rule("required")
            ->placeholder("请输入 销量");

        $edit->add('sort_order', '排序', 'text');

        $edit->add('viewed', '浏览数', 'text');


        $edit->add('image', '封面图', 'text')
            ->attributes(['readOnly' => true]);

        $edit->add('images', '相册', 'text')
            ->attributes(['readOnly' => true])->updateValue(implode(',', $images));

//        $form->add('tags', '标签', 'checkboxgroup')->options(Platv4HeadlineTag::where('status', Platv4HeadlineTag::COMMON_STATUS_NORMAL)->orderBy('sort', 'asc')->pluck('name', 'id'));

        $edit->add('status', '状态', 'select')->options(OcProduct::$statusText);

        $edit->add('categories', '分类', 'checkboxgroup')
            ->options(OcCategory::where([
                'status' => OcCategory::STATUS_COMMON_NORMAL,
            ])->orderBy('sort_order', 'asc')->pluck('name', 'category_id'));

        $edit->add('depot_id', '仓库', 'radiogroup')
            ->options(OcDepot::orderBy('sort_order', 'asc')->pluck('name', 'depot_id'));

        $edit->add('date_modified', 'date', 'hidden')->updateValue(date('Y-m-d H:i:s'));

        $edit->saved(function () use ($edit) {

            $productId = $edit->model->product_id;
            $product = OcProduct::find($productId);
            $product->model = $edit->model->title;
            $product->save();

            $product->images = explode(',', Input::get('images', ''));
            $this->saveProduct($product);
        });

        $edit->build();

        return $edit->view('toy.product.edit', compact('edit', 'id', 'imageDir', 'images'));
    }


    private function saveProduct($product)
    {
        $productDesc = OcProductDescription::find($product->product_id);
        empty($productDesc) && $productDesc = new OcProductDescription();

        $productDesc->product_id = $product->product_id;
        $productDesc->language_id = OcProductDescription::LANG_ID;
        $productDesc->name = $product->title;
        $productDesc->description = $product->content;
        $productDesc->meta_title = $product->title;
        $productDesc->meta_description = $product->title;
        $productDesc->meta_keyword = $product->title;

        $productDesc->save();

        OcProductImage::where('product_id', $product->product_id)->delete();
        $images = [];
        foreach ((array)$product->images as $key => $image) {
            if ($key >= 6) break; //限制6张
            if (empty($image)) continue;
            $images[] = [
                'product_id' => $product->product_id,
                'image' => $image,
                'sort_order' => $key
            ];
        }
        $images && DB::table('oc_product_image')->insert($images);

        OcProductToCategory::where('product_id', $product->product_id)->delete();
        $categories = [];
        foreach ((array)Input::get('categories') as $key => $category) {
            if (empty($category)) continue;
            $categories[] = [
                'product_id' => $product->product_id,
                'category_id' => $category,
            ];
        }
        $categories && DB::table('oc_product_to_category')->insert($categories);
    }
}
