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

</div>
</body>
<script>
    $(document).ready(function(){
        var url = API_CATEGORY_GET_LISTS + "?page=" + "{{$page}}";
//        alert(url);
        var method = "post";
        var data ={};
        data.per_page = 5;
        $.ajax({
            url: url,
            type: method,     //请求类型
            data: data,  //请求的数据
            dataType: "json",  //数据类型
            success: function (data) {
                var current_page = data.data.current_page;
                var next_page = current_page+1;
                var prev_page = current_page-1;
                var cateLists = data.data.data;
                console.log(cateLists);
                var lists = "";
                jQuery.each(cateLists,function(key,value) {
                    lists +=
                            "<a href='/categories/"+value.category_id+"'><div class='weui-cell'><div class='weui-cell__bd'>"+
                                "<p>ID："+value.category_id+"</p>"+
                                "<p>名称："+value.name+"</p>"+
                                "<p>仓库："+value.depot_name+"</p>"+
                                "<p>零售价：￥"+value.retail_price+"</p>"+
                                "<p>规格："+value.option_name+"</p></div><div class='weui-cell__ft'><img class='images' src='../images/avatar.jpg'></div>"+
                            "</div></a>";
                })
                {{--<div>--}}
                {{--<div style="display: inline-block;float: left;margin-left: 20%;margin-bottom: 0.6rem">--}}
                        {{--<a href="{{ url('/categories') }}?page={{$page-1}}" class="weui-btn weui-btn_plain-default">上一页</a>--}}
                        {{--</div>--}}
                        {{--<div style="display: inline-block;float: right;margin-right: 20%">--}}
                        {{--<a href="{{ url('/categories') }}?page={{$page+1}}" class="weui-btn weui-btn_plain-default">下一页</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                lists +=
                        "<div><div style='display: inline-block;float: left;margin-left: 20%;margin-bottom: 0.6rem'><a href='/categories?page="+prev_page+
                        "' class='weui-btn weui-btn_plain-default'>上一页</a></div>"+"<div style='display: inline-block;float: left;margin-left: 20%;margin-bottom: 0.6rem'><a href='/categories?page="+next_page+
                        "' class='weui-btn weui-btn_plain-default'>下一页</a></div>";
                $("#cateLists").html(lists);
            },
            error: function (data) {
            },
        })
    })
</script>
</html>