<?php

namespace App\Admin\Controllers\Toy;

use App\Admin\Controllers\BaseController;
use App\Models\Toy\OcProduct;
use Encore\Admin\Facades\Admin;
use Garyvv\WebCreator\WeChatCreator;
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
        $filter = DataFilter::source(new OcProduct());

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
        $grid->add('image', '封面图', true);
        $grid->add('status', '状态', true);
        $grid->add('date_added', '创建日期', true);

        $grid->add('operation','操作', false);

        $grid->orderBy('date_added', 'desc');

        $url = new Url();
        $grid->link($url->append('export', 1)->get(), "导出Excel", "TR", ['class' => 'btn btn-export', 'target' => '_blank']);
        $grid->link(config('admin.route.prefix') . '/toy/create', '新增', 'TR', ['class' => 'btn btn-default']);

        $grid->row(function ($row) {
            $row->cell('status')->value = OcProduct::$statusText[$row->data->status];

            ($row->data->status == OcProduct::STATUS_COMMON_NORMAL) && $row->cell('status')->style("color: #333333;");
            ($row->data->status == OcProduct::STATUS_COMMON_OFFLINE) && $row->cell('status')->style("color: #CECECE;");

//            skin: 'layui-layer-rim', //加上边框
//            shadeClose: true,   //点击遮罩关闭
            if ($row->data->content) $link = $row->data->content;
            else $link = '(空)';

            $btnEditHtml = "btn: ['编辑'],btn1: function(index, layero){
                                //按钮【按钮一】的回调
                                window.location.href = '" . config('admin.route.prefix') . "/html?product_id=" . $row->data->product_id . "&link=" . $link . "';
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
            $btnEdit = "<a class='btn btn-default' href='" . config('admin.route.prefix') . "/toy/products/edit?modify=" . $row->data->product_id . "'>编辑</a>";
            $btnDelete = '<button class="btn btn-danger" onclick="layer.confirm( \'确定删除吗？！\',{ btn: [\'确定\',\'取消\'] }, function(){ window.location.href = \'' . config('admin.route.prefix') . "/toy/products/edit?delete=" . $row->data->id . '\'})">删除</button>';

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
        $form->link(config('admin.route.prefix') . "/toy/products", "列表", "TR")->back();

        $form->add('title', '标题', 'text')
            ->rule("required|min:2")
            ->placeholder("请输入 标题");

        $form->add('textbox','内容','textarea')->rule("required")->attributes(['rows' => 15]);

        $form->add('image', '封面图', 'text')
            ->attributes(['readOnly' => true]);

//        $form->add('tags', '标签', 'checkboxgroup')->options(Platv4HeadlineTag::where('status', Platv4HeadlineTag::COMMON_STATUS_NORMAL)->orderBy('sort', 'asc')->pluck('name', 'id'));

        $form->add('status', '状态', 'select')->options(OcProduct::$statusText);

        $form->add('date_added', 'date', 'hidden')->insertValue(date('Y-m-d H:i:s'));


        $form->saved(function () use ($form) {
            try{
//                $this->saveHeadlineTag($form->model->id, Input::get('tags'));
                $productId = $form->model->product_id;
                if (Input::get('textbox', null)) {
                    $web = new WeChatCreator(Input::get('textbox'));
                    $path = 'toy/products/' . $productId . '/';
                    $dir = public_path($path);
                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                    }
                    $httpServer = env('HTTP_SERVER') . $path;
                    $web->dealImage($dir, $httpServer, 'text');
                    $product = OcProduct::find($productId);
                    $product->content = $web->link;
                    $product->save();
                }

                $form->message("新建商品成功");
                $form->link(config('admin.route.prefix') . '/toy/products',"返回");
            } catch (\Exception $exception) {
                $form->message('** <h3>【ERROR】</h3>下载外链图片错误 **：' . $exception->getMessage());
                $form->link(config('admin.route.prefix') . '/html?product_id=' . $form->model->product_id,"重新编辑HTML");
            }
        });

        $form->submit('保存');

        $imageDir = date('Ymd') . 'U' . Admin::user()->id;
        return $form->view('rapyd.textbox-form', compact('form', 'imageDir', 'type'));
    }


    public function anyEdit()
    {
        $deleteId = Input::get('delete', null);
        if ($deleteId) {
            Platv4Headline::where('id', $deleteId)->update(['status' => -1]);
            return redirect('/headlines');
        }

        $id = Input::get('modify', 0);
        if ($id) {
            $tagList = Platv4HeadlineToTag::where('headline_id', $id)->get()->toArray();
            $tags = array_column($tagList, 'headline_tag_id');
            Input::offsetSet('tags', array_values($tags));   // 选中tags
        }

        $edit = DataEdit::source(new Platv4Headline());

        $edit->label('头条信息');
        $edit->link(config('admin.route.prefix') . "/headlines", "列表", "TR")->back();

        $edit->add('title', '标题', 'text')
            ->rule("required|min:2")
            ->placeholder("请输入 标题");

        $edit->add('author', '来源', 'text')
            ->rule("required|min:1")
            ->placeholder("请输入 来源");

        $edit->add('style', '样式', 'radiogroup')->options(Platv4Headline::$styleText);

        $edit->add('link','链接','text')->rule("required")->placeholder("请输入 链接");

        $edit->add('thumb', '封面图', 'text')
            ->attributes(["readOnly" => true]);

        $edit->add('tags', '标签', 'checkboxgroup')->options(Platv4HeadlineTag::where('status', Platv4HeadlineTag::COMMON_STATUS_NORMAL)->orderBy('sort', 'asc')->pluck('name', 'id'));

        $edit->add('status', '状态', 'select')->options(Platv4Headline::$statusText);

        $edit->saved(function () use ($edit) {
            $this->saveHeadlineTag($edit->model->id, Input::get('tags'));
        });

        $edit->build();

        $imageDir = date('Ymd') . 'U' . Admin::user()->id;
        return $edit->view('headline.edit', compact('edit', 'id', 'imageDir'));
    }


    private function saveHeadlineTag($headlineId, $tags)
    {
        if(empty($headlineId)) return false;
        if(empty($tags)) return true;

        Platv4HeadlineToTag::where('headline_id', $headlineId)->delete();
        $insertData = [];
        foreach ($tags as $tag) {
            $insertData[] = [
                'headline_id' => $headlineId,
                'headline_tag_id' => $tag,
            ];
        }
        return DB::table('platv4_headline_to_tag')->insert($insertData);
    }

    private function saveHeadlineTagBak($headlineId, $tags)
    {
        if(empty($headlineId)) return false;
        if(empty($tags)) return true;

        Platv4HeadlineToTag::where('headline_id', $headlineId)->update(['status' => Platv4HeadlineToTag::COMMON_STATUS_DELETE]);
        $initSql = 'INSERT INTO `platv4_headline_to_tag` (`headline_id`, `headline_tag_id`, `status`)
                      VALUES ';
        $sql = '';
        foreach ($tags as $tag) {
            $sql .=  '(' . intval($headlineId) . ', ' . intval($tag) . ', ' . Platv4HeadlineToTag::COMMON_STATUS_NORMAL . '),';
        }
        $sql = substr($sql, 0, -1) . ' ON DUPLICATE KEY UPDATE `status` = VALUES(status);';
        DB::insert(DB::raw($initSql . $sql));
        return true;
    }

    public function editHtml()
    {
        $id = Input::get('id', null);
        $link = Input::get('link', null);

        $content = $link ? file_get_contents($link) : '';

        $imageDir = date('Ymd') . 'U' . Admin::user()->id;

        return view('headline.article', compact('content', 'id', 'imageDir'));
    }

    public function updateHtml()
    {
        $id = Input::get('id', null);
        $imageDir = Input::get('image_dir', null);
        $content = Input::get('content', null);
        $ajax = Input::get('ajax', false);
        $result = $this->dealWeChatImage($imageDir, $content, $ajax, $id);

        if ($ajax) return $this->respData(['content' => $result]);
        else {
            $data = Platv4Headline::find($id);
            if ($data) {
                $data->link = $result;
                $data->save();
            }
            return redirect('/headlines');
        }
    }
}