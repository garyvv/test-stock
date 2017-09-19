@extends('Stock.base')
@section('content')
<style>
    .fr{
        margin-right: 10px;
        float: right;
    }
</style>
    <div id="cateDetail">

    </div>
    <script>
        var token = getCookie('token');

        $(document).ready(function () {
            var url = API_CATEGORY_URL + "/{{$cid}}";
            var method = "get";
            var data = {};
            $.ajax({
                headers:{
                    token:token
                },
                url: url,
                type: method,
                data: data,
                dataType: "json",
                success: function (data) {
                    var data = data.data;
                    var cateDetail = "";
                    cateDetail +=
                            "<div class = 'fr'>"+
                            " <a href='javascript:;' class='weui-btn weui-btn_mini weui-btn_primary' onclick='javascript:return deleteCategory()'>DELETE</a>" +
                            " <a href='/categories/" + data.category_id + "/edit' class='weui-btn weui-btn_mini weui-btn_primary'>EDIT</a>" +
                            "</div>"+
                            "<div class='weui-msg'>" +
                            "<div class='weui-msg__icon-area'></div>" +
                            "<div class='weui-msg__text-area'>" +
                            "<h2 class='weui-msg__title'><img src='../images/avatar.JPG'></h2>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cells'>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>类别名称:" + data.name + "</p>" +
                            "<p>商品规格:" + data.option_name + "</p>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>入货价</p>" +
                            "<p>￥" + data.purchasing_price + "</p>" +
                            "</div>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>批发价</p>" +
                            "<p>￥" + data.wholesale_price + "</p>" +
                            "</div>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>零售价</p>" +
                            "<p>￥" + data.retail_price + "</p>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>总入货</p>" +
                            "<p>" + data.purchase_amount + "</p>" +
                            "</div>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>总销售</p>" +
                            "<p>" + data.selling_amount + "</p>" +
                            "</div>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>现库存</p>" +
                            "<p>" + data.inventory + "</p>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div>" +
                            "<p>供应商：" + data.seller_name + "</p>" +
                            "<p>地址：" + data.address + "</p>" +
                            "<p>联系人：" + data.contact + "</p>" +
                            "<p>联系电话：" + data.phone + "</p>" +
                            "</div>" +
                            "</div>";
                    $("#cateDetail").html(cateDetail);
                },
                error: function (data) {
                },

            });
        });

        function deleteCategory(){
            var msg = "您真的确定要删除吗？";
            if (confirm(msg)==true){
                var data = {};
                data.cid = "{{$cid}}";
                var url = API_CATEGORY_URL + "/{{$cid}}/delete";
                var method = "delete";
                $.ajax({
                    headers:{
                        token:token
                    },
                    url: url,
                    data: data,
                    method: method,
                    dataType: 'json',
                    success:function(data)
                    {
                        $.toast(data.msg, function () {
                            window.location.href = "/categories";
//                    console.log(data.data.category_id);
                        });
                    },
                    error: function (data)
                    {

                    }
                })
            }else{
                return false;
            }
        }

    </script>

@stop