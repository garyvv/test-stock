@extends('Stock.base')
@section('content')

<style>
    .editButton
    {
        display: inline-block;
        border-radius: 14px;
        margin-top: 10px;
        margin-right: 20px;
        float: right;
    }
    .sellerTitle
    {
        text-align: center;;
    }
</style>
<div id="purchaseRecordDetail">

</div>
<script>
    var token = getCookie('token');

    $(document).ready(function () {
        var url = API_PURCHASE_RECORD_URL + "/getForm";
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
                var purchaseRecordDetail = "";
                purchaseRecordDetail +=
                        "<form>" +
                        "<div class='weui-cells weui-cells_form'>" +
                        "<div class='weui-cell'>" +
                        "<div class='weui-cell__bd'>" +
                        "商品分类名称：" +
                        "<select id = 'category_id' name='category_id'>";

                $.each(data, function (key, category) {
                    purchaseRecordDetail += "<option value='" + category.category_id + "'";
                    if (data.category_id == category.category_id) {
                        purchaseRecordDetail += "selected = 'selected'>" + category.name + "</option>";
                    } else {
                        purchaseRecordDetail += ">" + category.name + "</option>";
                    }
                });

                purchaseRecordDetail += "</select>" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                        "<div class='weui-cell__hd'>" +
                        "<label class='weui-label'>购买数量:</label>" +
                        "</div>" +
                        "<div class='weui-cell__bd'>" +
                        "<input class='weui-input' type='number' id='quantity' name='quantity' pattern='[0-9]*' placeholder='请输入购买数量'>" +
                        "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                        "<div class='weui-cell__hd'>" +
                        "<label class='weui-label'>价格:</label>" +
                        "</div>" +
                        "<div class='weui-cell__bd'>" +
                        "<input class='weui-input' type='number' id='total' name='total' pattern='[0-9]*' placeholder='请输入商品价格'>" +
                        "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                        "<div class='weui-cell__hd'>" +
                        "<label class='weui-label'>运费:</label>" +
                        "</div>" +
                        "<div class='weui-cell__bd'>" +
                        "<input class='weui-input' type='number' id='freight' name='freight' pattern='[0-9]*' placeholder='请输入运费'>" +
                        "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                        "<div class='weui-cell__hd'>" +
                        "<label class='weui-label'>购买时间:</label>" +
                        "</div>" +
                        "<div class='weui-cell__bd'>" +
                        "<input class='weui-input' type='date' id='purchase_time' name='purchase_time'>" +
                        "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                        "<div class='weui-cell__hd'>" +
                        "<label class='weui-label'>注释:</label>" +
                        "</div>" +
                        "<div class='weui-cell__bd'>" +
                        "<textarea class='weui-textarea' placeholder='请输入注释' id='comment' name='comment' rows='3'></textarea>" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "<input type='button' class='weui-btn weui-btn_primary' id='submit' onclick='createPurchaseRecord()' value='提交'>" +
                        "</form>";
                $("#purchaseRecordDetail").html(purchaseRecordDetail);
            },
            error: function () {

            }
        })
    });

    function createPurchaseRecord(){
        var data = {};
        data.category_id = $('#category_id').val();
        data.quantity = $('#quantity').val();
        data.total = $('#total').val();
        data.freight = $('#freight').val();
        data.purchase_time = $('#purchase_time').val();
        data.comment = $('#comment').val();
        var url = API_PURCHASE_RECORD_URL + "/create";
        var method = "post";
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
                    window.location.href = "/purchase_records";
                });
            },
            error: function (data) {
            },
        })
    }
</script>

@stop