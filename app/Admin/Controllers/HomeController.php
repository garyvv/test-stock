<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StCustomer;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;

use App\Models\StSeller;
use App\Models\StDepot;
use App\Models\StCategory;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('管理面板');
            $content->description('金利玩具库存系统');

//            $content->row(function ($row) {
//                $row->column(4, new InfoBox('经销商', 'book', 'aqua', '/admin/sellers', StSeller::count()));
//                $row->column(4, new InfoBox('商品类', 'file', 'yellow', '/admin/categories', StCategory::count()));
//                $row->column(4, new InfoBox('仓库位置', 'shopping-cart', 'green', '/admin/depots', StDepot::count()));
//            });


            $content->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $data['user_count'] = StCustomer::count();
                    $data['order_count'] = StCategory::count();
                    $data['seller_count'] = StSeller::count();
                    $data['product_count'] = StCategory::count();
                    $column->append(view('admin-custom/base', compact('data')));
                });

            });


            $day = 6;
            $data = [
                4, 6, 7, 2, 1, 8
            ];

            $labels = [
                '2017-07-10',
                '2017-07-11',
                '2017-07-12',
                '2017-07-13',
                '2017-07-14',
                '2017-07-15',
            ];

            $content->row(function (Row $row) use ($data, $labels, $day) {

                $row->column(12, function (Column $column) use ($labels, $data, $day) {
                    $line = new Line([
                        'labels' => $labels,
                        'datasets' => [
                            [
                                'label' => "My First dataset",
                                'fillColor' => "rgba(0,255,0,0.2)",
                                'data' => $data
                            ]
                        ],
                    ]);
                    $line->options([
                        'pointDot' => true
                    ]);

                    $column->append((new Box('近' . $day . '天订单统计', $line))->style('success'));

                });


            });


        });
    }
}
