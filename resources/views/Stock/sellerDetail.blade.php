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
<div id="sellerDetail">

</div>
<script>
    var token = getCookie('token');

    $(document).ready(function () {
        var url = API_SELLER_URL + "/{{$sid}}" + "/detail";
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
                var sellerDetail = "";
                sellerDetail +=
                    "<h1 class='sellerTitle'>经销商信息</h1>"+
                    "<div class='weui-cells'>" +
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>经销商名称: " + data.name + "</p>" +
                            "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>联系人: " + data.contact + "</p>" +
                            "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>地址: " + data.address + "</p>" +
                            "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>联系电话: " + data.phone + "</p>" +
                            "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>开户银行: " + data.bank + "</p>" +
                            "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>开户账号: " + data.account + "</p>" +
                            "</div>" +
                        "</div>" +
                    "</div>"+
                    " <a href='/sellers/" + data.seller_id + "/edit' class='weui-btn weui-btn_primary editButton'>EDIT" +
                    "</a>"
                $("#sellerDetail").html(sellerDetail);
            },
            error: function (data) {
            },

        });
    })
</script>

@stop