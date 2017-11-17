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
        var sellerDetail = "";
        sellerDetail +=
                "<form>" +
                "<div class='weui-cells weui-cells_form'>" +
                "<div class='weui-cell'>"+
                "<div class='weui-cell__hd'>" +
                "<label class='weui-label'>" +
                "经销商名称:" +
                "</label>" +
                "</div>"+
                "<div class='weui-cell__bd'>" +
                "<input class='weui-input' type='text' id='name' name='name' placeholder='请输入经销商名称' >" +
                "</div>" +
                "</div>"+
                "<div class='weui-cell'>"+
                "<div class='weui-cell__hd'>" +
                "<label class='weui-label'>" +
                "联系人:" +
                "</label>" +
                "</div>"+
                "<div class='weui-cell__bd'>" +
                "<input class='weui-input' type='text' id='contact' name='contact' placeholder='请输入联系人名字'>" +
                "</div>" +
                "</div>"+
                "<div class='weui-cell'>"+
                "<div class='weui-cell__hd'>" +
                "<label class='weui-label'>" +
                "地址:" +
                "</label>" +
                "</div>"+
                "<div class='weui-cell__bd'>" +
                "<textarea class='weui-textarea' id='address' name='address' placeholder='请输入地址' rows='3'></textarea>" +
                "</div>" +
                "</div>"+
                "<div class='weui-cell'>"+
                "<div class='weui-cell__hd'>" +
                "<label class='weui-label'>" +
                "联系电话:" +
                "</label>" +
                "</div>"+
                "<div class='weui-cell__bd'>" +
                "<input class='weui-input' type='number' id='phone' name='phone' pattern='[0-9]*'  placeholder='请输入手机号'>" +
                "</div>" +
                "</div>"+
                "<div class='weui-cell'>"+
                "<div class='weui-cell__hd'>" +
                "<label class='weui-label'>" +
                "开户银行:" +
                "</label>" +
                "</div>"+
                "<div class='weui-cell__bd'>" +
                "<input class='weui-input' type='text' id='bank' name='bank' placeholder='请输入开户银行' >" +
                "</div>" +
                "</div>"+
                "<div class='weui-cell'>"+
                "<div class='weui-cell__hd'>" +
                "<label class='weui-label'>" +
                "开户账号:" +
                "</label>" +
                "</div>"+
                "<div class='weui-cell__bd'>" +
                "<input class='weui-input' type='number' id='account' name='account' pattern='[0-9]*' placeholder='请输入开户账号'>" +
                "</div>" +
                "</div>"+
                "</div>" +
                "<input type='button' class='weui-btn weui-btn_primary' id='submit' onclick='createSeller()' value='提交'>" +
                "</form>";
        $("#sellerDetail").html(sellerDetail);
    })

    function createSeller(){
        var data = {};
        data.name = $('#name').val();
        data.contact = $('#contact').val();
        data.address = $('#address').val();
        data.phone = $('#phone').val();
        data.bank = $('#bank').val();
        data.account = $('#account').val();
        console.log(data);
        var url = API_SELLER_URL;
        var method = "post";
        $.ajax({
            headers: {
                token: token
            },
            url:url,
            type:method,
            data:data,
            dataType:"json",
            success:function(data)
            {
                $.toast(data.msg, function () {
                    window.location.href = "/sellers";
//                    console.log(data.data.category_id);
                });
            },
            error:function(data){
                alert("fail");
            }
        })
    }
</script>

@stop