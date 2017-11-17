@extends('Stock.base')
@section('content')

<style>
    .fr{
        float: right;
        margin-right: 10px;
    }
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
        var url = API_SELLER_URL + "/{{$sid}}";
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
                    "<div class='fr'>"+
                    " <a href='javascript:;' class='weui-btn weui-btn_mini weui-btn_primary ' onclick='javacript:return deleteSeller()'>DELETE" +
                    "</a>"+
                    " <a href='/sellers/" + data.seller_id + "/edit' class='weui-btn weui-btn_mini weui-btn_primary '>EDIT" +
                    "</a></div>";
                $("#sellerDetail").html(sellerDetail);
            },
            error: function (data) {
            },

        });
    })

    function deleteSeller(){
        var msg = "您真的确定要删除吗?";
        if (confirm(msg)==true)
        {
            var url = API_SELLER_URL + "/{{$sid}}";
            var data = {};
            var method = "delete";
            data.seller_id = "{{$sid}}";
            $.ajax({
                headers:{
                    token : token
                },
                url:url,
                data:data,
                type:method,
                dataType:'json',
                success:function(data){
                    $.toast(data.msg, function () {
                        window.location.href = "/sellers";
//                    console.log(data.data.category_id);
                    });
                },
                error:function(data){
                }
            });
        }
        else
        {
            return false;
        }
    }

</script>

@stop