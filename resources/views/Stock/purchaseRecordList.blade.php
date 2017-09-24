@extends('Stock.base')
@section('content')
    <style>
        .images {
            width: 80px;
        }
    </style>
    <a href="/purchase_records/create" class='nav-btn' >CREATE</a>
    <p class="p-title" onclick="javascript:window.location.href='/'"><i class="weui-icon-circle"></i>首页</p>
    <div id="purchaseRecordLists">
        {{--//数据加载在此--}}
    </div>
    <div class="weui-loadmore">
        <i class="weui-loading"></i>
        <span class="weui-loadmore__tips">正在加载</span>
    </div>
    <script>
        var loading = false;  //状态标记
        var page = 1;//声明页码的全局变量
        var token = getCookie('token');

        $(document).ready(function () {//页面加载完毕后执行
            var url = API_PURCHASE_RECORD_URL + "?page=" + page;
            var method = "get";
            var data = {};
            data.per_page = 5;
            $.ajax({
                headers:{
                    token:token
                },
                url: url,
                type: method,     //请求类型
                data: data,  //请求的数据
                dataType: "json",  //数据类型
                success: function (data) {
                    page = data.data.current_page;//记录当前页码
                    var purchaseRecordLists = data.data.data;
                    console.log(purchaseRecordLists);
                    var lists = "";
                    jQuery.each(purchaseRecordLists, function (key, value) {
                        lists +=
                                "<a href='/purchase_records/" + value.purchase_record_id + "'><div class='weui-cells list-item'><div class='weui-cell__bd'>" +
                                "<p>ID：" + value.purchase_record_id + "</p>" +
                                "<p class='p-name'>商品分类名称：" + value.name + "</p>" +
                                "<p>购买数量：" + value.quantity + "</p>" +
                                "<p>购买时间：" + value.purchase_time + "</p>" +
                                "<p>价格：" + value.total + "</p>" +
                                "<p>运费：" + value.freight + "</p>" +
                                "<p class='p-tag'>注释：" + value.comment + "</p>" +
                                "</div></div></a>";
                    })
                    $("#purchaseRecordLists").html(lists);
                },
                error: function (data) {
                },
            })
        })


        $(document.body).infinite(100).on("infinite", function () {//上拉加载
            if (loading) return;
            loading = true;
            page = parseInt(page) + 1;
            console.log(page);
            var url = API_PURCHASE_RECORD_URL + "?page=" + page;
            var method = "get";
            var data = {};
            data.per_page = 5;
            $.ajax({
                headers:{
                    token:token
                },
                url: url,
                type: method,     //请求类型
                data: data,  //请求的数据
                dataType: "json",  //数据类型
                success: function (data) {
                    var purchaseRecordLists = data.data.data;
                    var lists = "";
                    setTimeout(function () {
                        jQuery.each(purchaseRecordLists, function (key, value) {
//                            console.log(cateLists);
                            lists +=
                                    "<a href='/purchase_records/" + value.purchase_record_id + "'><div class='weui-cells list-item'><div class='weui-cell__bd'>" +
                                    "<p>ID：" + value.purchase_record_id + "</p>" +
                                    "<p class='p-name'>商品分类名称：" + value.name + "</p>" +
                                    "<p>购买数量：" + value.quantity + "</p>" +
                                    "<p>购买时间：" + value.purchase_time + "</p>" +
                                    "<p>价格：" + value.total + "</p>" +
                                    "<p>运费：" + value.freight + "</p>" +
                                    "<p class='p-tag'>注释：" + value.comment + "</p>" +
                                    "</div></div></a>";
                        })
                        $("#purchaseRecordLists").append(lists);
                        loading = false;
                    }, 1500)
                },
                error: function (data) {
                    alert(1)
                },
            })
        });

    </script>

@stop