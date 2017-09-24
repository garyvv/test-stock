@extends('Stock.base')
@section('content')
    <style>
        .images {
            width: 80px;
        }
    </style>
    <a href="/depots/create" class='nav-btn' >CREATE</a>
    <p class="p-title" onclick="javascript:window.location.href='/'"><i class="weui-icon-circle"></i>首页</p>

    <div id="depotLists">
        {{--//数据加载在此--}}
    </div>
    {{--<div class="weui-loadmore">--}}
        {{--<i class="weui-loading"></i>--}}
        {{--<span class="weui-loadmore__tips">正在加载</span>--}}
    {{--</div>--}}
    <script>
        var loading = false;  //状态标记
        var page = 1;//声明页码的全局变量
        var token = getCookie('token');

        $(document).ready(function () {//页面加载完毕后执行
            var url = API_DEPOT_URL + "?page=" + page;
            var method = "get";
            var data = {};
            data.per_page = 20;
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
                    var depotLists = data.data.data;
                    console.log(depotLists);
                    var lists = "";
                    jQuery.each(depotLists, function (key, value) {
                        lists +=
                                "<a href='/depots/" + value.depot_id + "'><div class='weui-cells list-item'><div class='weui-cell__bd'>" +
                                "<p>ID：" + value.depot_id + "</p>" +
                                "<p class='p-name'>名称：" + value.name + "</p>" +
                                "</div></div></a>";
                    });
                    if (data.data.last_page == page) {
                        lists += genEndFooter();
                        $(".weui-loadmore").hide();
                    }
                    $("#depotLists").html(lists);
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
            var url = API_DEPOT_URL + "?page=" + page;
            var method = "get";
            var data = {};
            data.per_page = 20;
            $.ajax({
                headers:{
                    token:token
                },
                url: url,
                type: method,     //请求类型
                data: data,  //请求的数据
                dataType: "json",  //数据类型
                success: function (data) {
                    var depotLists = data.data.data;
                    var lists = "";
                    setTimeout(function () {
                        jQuery.each(depotLists, function (key, value) {
//                            console.log(cateLists);
                            lists +=
                                    "<a href='/depots/" + value.depot_id + "'><div class='weui-cells list-item'><div class='weui-cell__bd'>" +
                                    "<p>ID：" + value.depot_id + "</p>" +
                                    "<p class='p-name'>名称：" + value.name + "</p>" +
                                    "</div></div></a>";
                        });
                        if (data.data.last_page == page) {
                            lists += genEndFooter();
                            $(".weui-loadmore").hide();
                        }
                        $("#depotLists").append(lists);
                        loading = false;
                    }, 1500)
                },
                error: function (data) {
                    alert(1)
                }
            })
        });

    </script>

@stop