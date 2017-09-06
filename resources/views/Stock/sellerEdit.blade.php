@extends('Stock.base')
@section('content')

    <div id="sellerDetail">
        //detail加载位置

    </div>
    <script>
        var token = getCookie('token');

        $(document).ready(function () {
            var url = API_SELLER_URL + "/" + "{{$sid}}" + "/edit";
            var method = "post";
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
                            "<form>" +
                            "<input type='hidden' id='seller_id' name='seller_id' value='" + data.seller_id + "'/>" +
                            "<div class='weui-cells weui-cells_form'>" +
                                "<div class='weui-cell'>"+
                                    "<div class='weui-cell__hd'>" +
                                        "<label class='weui-label'>" +
                                                "经销商名称:" +
                                        "</label>" +
                                    "</div>"+
                                    "<div class='weui-cell__bd'>" +
                                        "<input class='weui-input' type='text' id='name' name='name' placeholder='请输入经销商名称' value='" + data.name + "'>" +
                                    "</div>" +
                                "</div>"+
                                "<div class='weui-cell'>"+
                                    "<div class='weui-cell__hd'>" +
                                        "<label class='weui-label'>" +
                                                "联系人:" +
                                        "</label>" +
                                    "</div>"+
                                    "<div class='weui-cell__bd'>" +
                                        "<input class='weui-input' type='text' id='contact' name='contact' placeholder='请输入联系人名字' value='" + data.contact + "'>" +
                                    "</div>" +
                                "</div>"+
                                "<div class='weui-cell'>"+
                                    "<div class='weui-cell__hd'>" +
                                        "<label class='weui-label'>" +
                                                "地址:" +
                                        "</label>" +
                                    "</div>"+
                                    "<div class='weui-cell__bd'>" +
                                        "<textarea class='weui-textarea' id='address' name='address' placeholder='请输入地址' rows='3'>"+data.address+"</textarea>" +
                                    "</div>" +
                                "</div>"+
                                "<div class='weui-cell'>"+
                                    "<div class='weui-cell__hd'>" +
                                        "<label class='weui-label'>" +
                                                "联系电话:" +
                                        "</label>" +
                                    "</div>"+
                                    "<div class='weui-cell__bd'>" +
                                        "<input class='weui-input' type='number' id='phone' name='phone' pattern='[0-9]*'  placeholder='请输入手机号' value='" + data.phone + "'>" +
                                    "</div>" +
                                "</div>"+
                                "<div class='weui-cell'>"+
                                    "<div class='weui-cell__hd'>" +
                                        "<label class='weui-label'>" +
                                                "开户银行:" +
                                        "</label>" +
                                    "</div>"+
                                    "<div class='weui-cell__bd'>" +
                                        "<input class='weui-input' type='text' id='bank' name='bank' placeholder='请输入开户银行' value='" + data.bank + "'>" +
                                    "</div>" +
                                "</div>"+
                                "<div class='weui-cell'>"+
                                    "<div class='weui-cell__hd'>" +
                                        "<label class='weui-label'>" +
                                                "开户账号:" +
                                        "</label>" +
                                    "</div>"+
                                    "<div class='weui-cell__bd'>" +
                                        "<input class='weui-input' type='number' id='account' name='account' pattern='[0-9]*' placeholder='请输入开户账号' value='" + data.account + "'>" +
                                    "</div>" +
                                "</div>"+
                            "</div>" +
                            "<input type='button' class='weui-btn weui-btn_primary' id='submit' onclick='updateSeller()' value='提交'>" +
                            "</form>";
                    $("#sellerDetail").html(sellerDetail);
                },
                error: function () {

                }
            })
        })

        function updateSeller() {
            var url = API_SELLER_URL + "/{{$sid}}/update";
            var data = {};
            data.seller_id = $('#seller_id').val();
            data.name = $('#name').val();
            data.contact = $('#contact').val();
            data.address = $('#address').val();
            data.phone = $('#phone').val();
            data.bank = $('#bank').val();
            data.account = $('#account').val();
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
                        window.location.href = "/sellers/" + data.data.seller_id;
//                    console.log(data.data.category_id);
                    });
                },
                error: function (data) {
                },
            })

        }
    </script>
@stop