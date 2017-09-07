@extends('Stock.base')
@section('content')

    <div id="cateDetail">
        {{--detail加载位置--}}

    </div>
    <script>
        var token = getCookie('token');

        $(document).ready(function () {
            var url = API_CATEGORY_URL + "/" + "{{$cid}}" + "/edit";
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
                    console.log(data);
                    var data = data.data;
                    var cateDetail = "";
                    cateDetail +=
                            "<form>" +
                            "<input type='hidden' id='category_id' name='category_id' value='" + data.category_id + "'/>" +
                            "<div class='weui-cells weui-cells_form'>" +
                            "<div class='weui-cells'>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                            "名称：" +
                            "<input class='weui-input' type='text' id='name' name='name' placeholder='请输入类别名称' value='" + data.name + "'>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cells'>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                            "供应商：" +
                            "<select id = 'seller_id' name='seller_id'>";
                    $.each(data.sellers, function (key, seller) {
                        cateDetail += "<option value='" + seller.seller_id + "'";
                        if (data.seller_id == seller.seller_id) {
                            cateDetail += "selected = 'selected'>" + seller.name + "</option>";
                        } else {
                            cateDetail += ">" + seller.name + "</option>";
                        }

                    });

                    cateDetail += "</select>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cells'>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                            "存放仓库：" +
                            "<select id = 'depot_id' name='depot_id'>";

                    $.each(data.depots, function (key, depot) {
                        cateDetail += "<option value='" + depot.depot_id + "'";
                        if (data.depot_id == depot.depot_id) {
                            cateDetail += "selected = 'selected'>" + depot.name + "</option>";
                        } else {
                            cateDetail += ">" + depot.name + "</option>";
                        }
                    })

                    cateDetail += "</select>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cells'>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell_bd'>" +
                            "批发价：" +
                            "<input class='weui-input' type='text' id='wholesale_price' name='wholesale_price' placeholder='请输入批发售价' value='" + data.wholesale_price + "'>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cells'>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell_bd'>" +
                            "零售价：" +
                            "<input class='weui-input' type='text' id='retail_price' name='retail_price' placeholder='请输入零售价格' value='" + data.retail_price + "'>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cells'>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell_bd'>" +
                            "入货价：" +
                            "<input class='weui-input' type='text' id='purchasing_price' name='purchasing_price' placeholder='请输入入货价格' value='" + data.purchasing_price + "'>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cells'>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell_bd'>" +
                            "会员价：" +
                            "<input class='weui-input' type='text' id='vip_price' name='vip_price' placeholder='请输入会员价格' value='" + data.vip_price + "'>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cells'>" +
                            "<div class='weui-cell'>" +
                            "<div class='weui-cell_bd'>" +
                            "类别规格：" +
                            "<input class='weui-input' type='text' id='option_name' name='option_name' placeholder='请输入类别规格' value='" + data.option_name + "'>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<input type='button' class='weui-btn weui-btn_primary' id='submit' onclick='updateCategory()' value='提交'>" +
                            "</div>" +
                            "</form>";
                    $("#cateDetail").html(cateDetail);
                },
                error: function () {

                }
            })
        });

        function updateCategory() {
            var url = API_CATEGORY_URL + "/{{$cid}}/update";
            var data = {};
            data.name = $('#name').val();
            data.category_id = $('#category_id').val();
            data.seller_id = $('#seller_id').val();
            data.depot_id = $('#depot_id').val();
            data.wholesale_price = $('#wholesale_price').val();
            data.retail_price = $('#retail_price').val();
            data.purchasing_price = $('#purchasing_price').val();
            data.vip_price = $('#vip_price').val();
            data.option_name = $('#option_name').val();
            var method = "put";
            $.ajax({
                headers:{
                    token:token
                },
                url: url,
                type: method,     //请求类型
                data: data,  //请求的数据
                dataType: "json",  //数据类型
                success: function (data) {
                    $.toast(data.msg, function () {
                        window.location.href = "/categories/" + data.data.category_id;
//                    console.log(data.data.category_id);
                    });
                },
                error: function (data) {
                }
            })
        }
    </script>
@stop