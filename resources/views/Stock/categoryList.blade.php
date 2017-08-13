<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ URL::asset('/weui/dist/lib/weui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/weui/dist/css/jquery-weui.min.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript"
            src="{{ URL::asset('/weui/dist/lib/jquery-2.1.4.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('/weui/dist/js/jquery-weui.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('/js/routes.js') }}"></script>
    <title>库存管理</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<style>
    .images{
        width:80px;
    }
</style>
<body>
<div class="weui-cells" id="cateLists">
{{--//数据加载在此--}}
</div>
<div class="weui-loadmore">
    <i class="weui-loading"></i>
    <span class="weui-loadmore__tips">正在加载</span>
</div>
</body>
<script>
    var loading = false;  //状态标记
    var page = "{{$page}}";//声明页码的全局变量
    $(document).ready(function(){//页面加载完毕后执行
        var url = API_CATEGORY_BASE_URL + "?page=" + "{{$page}}";
        var method = "post";
        var data ={};
        data.per_page = 5;
        $.ajax({
            url: url,
            type: method,     //请求类型
            data: data,  //请求的数据
            dataType: "json",  //数据类型
            success: function (data) {
                var page = data.data.current_page;//记录当前页码
                var cateLists = data.data.data;
                var lists = "";
                jQuery.each(cateLists,function(key,value) {
                    lists +=
                            "<a href='/categories/"+value.category_id+"'><div class='weui-cell' style='border-top: 1px solid #d9d9d9;'><div class='weui-cell__bd'>"+
                                "<p>ID："+value.category_id+"</p>"+
                                "<p>名称："+value.name+"</p>"+
                                "<p>仓库："+value.depot_name+"</p>"+
                                "<p>零售价：￥"+value.retail_price+"</p>"+
                                "<p>规格："+value.option_name+"</p></div><div class='weui-cell__ft'><img class='images' src='../images/avatar.JPG'></div>"+
                            "</div></a>";
                })
                $("#cateLists").html(lists);
            },
            error: function (data) {
            },
        })
    })


    $(document.body).infinite(100).on("infinite", function() {//上拉加载
        if(loading) return;
        loading = true;
        page = parseInt(page) + 1;
        console.log(page);
        var url = API_CATEGORY_BASE_URL + "?page=" + page;
        var method = "post";
        var data ={};
        data.per_page = 5;
        $.ajax({
            url: url,
            type: method,     //请求类型
            data: data,  //请求的数据
            dataType: "json",  //数据类型
            success: function (data) {
                var cateLists = data.data.data;
                var lists = "";
                setTimeout(function () {
                    jQuery.each(cateLists, function (key, value) {
                        console.log(cateLists);
                        lists +=
                                "<a href='/categories/" + value.category_id + "'><div class='weui-cell' style='border-top: 1px solid #d9d9d9;'><div class='weui-cell__bd'>" +
                                "<p>ID：" + value.category_id + "</p>" +
                                "<p>名称：" + value.name + "</p>" +
                                "<p>仓库：" + value.depot_name + "</p>" +
                                "<p>零售价：￥" + value.retail_price + "</p>" +
                                "<p>规格：" + value.option_name + "</p></div><div class='weui-cell__ft'><img class='images' src='../images/avatar.JPG'></div>" +
                                "</div></a>";
                    })
                    $("#cateLists").append(lists);
                    loading = false;
                }, 1500)
            },
            error: function (data) {
            },
        })
    });

</script>
</html>