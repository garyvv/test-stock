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
    <title>详情页</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>

<body>
<div></div>
<div id="cateDetail">

</div>
</body>
<script>
    $(document).ready(function(){
        var url = API_CATEGORY_GET_LISTS + "/" + "{{$cid}}"+"/detail";
        var method = "post";
        var data = {};
        $.ajax({
            url:url,
            type:method,
            data:data,
            dataType:"json",
            success:function(data){
                var data = data.data;
                var cateDetail = "";
                cateDetail +=
                        " <a href='/categories/"+data.category_id+"/edit'>"+
                        "<div class='weui-msg'>"+
                            "<div class='weui-msg__icon-area'></div>"+
                            "<div class='weui-msg__text-area'>"+
                                "<h2 class='weui-msg__title'><img src='../images/avatar.JPG'></h2>"+
                            "</div>"+
                        "</div>"+
                        "</a>"+
                        "<div class='weui-cells'>"+
                            "<div class='weui-cell'>"+
                                "<div class='weui-cell__bd'>"+
                                    "<p>类别名称:"+data.name+"</p>"+
                                    "<p>商品规格:"+data.option_name+"</p>"+
                                "</div>"+
                            "</div>"+
                            "<div class='weui-cell'>"+
                                "<div class='weui-cell__bd'>"+
                                    "<p>入货价</p>"+
                                    "<p>￥"+data.purchasing_price+"</p>"+
                                "</div>"+
                                "<div class='weui-cell__bd'>"+
                                    "<p>批发价</p>"+
                                    "<p>￥"+data.wholesale_price+"</p>"+
                                "</div>"+
                                "<div class='weui-cell__bd'>"+
                                     "<p>零售价</p>"+
                                     "<p>￥"+data.retail_price+"</p>"+
                                "</div>"+
                            "</div>"+
                            "<div class='weui-cell'>"+
                                "<div class='weui-cell__bd'>"+
                                    "<p>总入货</p>"+
                                    "<p>"+data.purchase_amount+"</p>"+
                                "</div>"+
                                "<div class='weui-cell__bd'>"+
                                    "<p>总销售</p>"+
                                    "<p>"+data.selling_amount+"</p>"+
                                "</div>"+
                                "<div class='weui-cell__bd'>"+
                                    "<p>现库存</p>"+
                                    "<p>"+data.inventory+"</p>"+
                                "</div>"+
                            "</div>"+
                        "</div>"+
                        "<div>"+
                            "<p>供应商："+data.seller_name+"</p>"+
                            "<p>地址："+data.address+"</p>"+
                            "<p>联系人："+data.contact+"</p>"+
                            "<p>联系电话："+data.phone+"</p>"+
                        "</div>"+
                    "</div>";
                $("#cateDetail").html(cateDetail);
//                console.log(data);
//                alert(data);

            },
            error: function (data) {
            },

        });
    })
</script>

</html>