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
        var url = API_PURCHASE_RECORD_URL + "/{{$pid}}" + "/detail";
        {{--var url = "/api/v1/sellers" + "/{{$sid}}" + "/detail";--}}
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
                    "<h1 class='sellerTitle'>购买记录信息</h1>"+
                    "<div class='weui-cells'>" +
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>ID: " + data.purchase_record_id + "</p>" +
                            "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>商品分类名称: " + data.name + "</p>" +
                            "</div>" +
                        "</div>"+
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>购买数量: " + data.quantity + "</p>" +
                            "</div>" +
                        "</div>"+
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>购买时间: " + data.purchase_time + "</p>" +
                            "</div>" +
                        "</div>"+
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>价格: " + data.total + "</p>" +
                            "</div>" +
                        "</div>"+
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>运费: " + data.freight + "</p>" +
                            "</div>" +
                        "</div>"+
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>注释: " + data.comment + "</p>" +
                            "</div>" +
                        "</div>"+
                    "</div>";
                $("#purchaseRecordDetail").html(purchaseRecordDetail);
            },
            error: function (data) {
            },

        });
    })
</script>

@stop