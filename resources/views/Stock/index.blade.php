@extends('Stock.base')
@section('content')
    <style>
        .weui-media-box__thumb {
            border-radius: 50%;
            overflow: hidden;
        }

        .avatar {
            display: inline-block;
        }

        .top img {
            /*display: inline-block;*/
            width: 100px;
        }

        .weui-cell__hd img {
            width: 40px;
            margin-right: 10px;
        }

        .name {
            display: inline-block;
        }

        body {
            background-color: #999;
        }
    </style>
    <div id="userInfo">

    </div>

    <script>

        $(document).ready(function () {
            var token = getCookie('token');
//            alert(token);
//            token = "";
            var url = API_USRS;
            var method = "get";
            var data = {};
            if (token=="") {
                alert("未登录");
                login();
            }
            $.ajax({
                headers:{
                    token:token,
                },
                url: url,
                type: method,
                data: data,
                dataType: "json",
                success: function (data) {
                    var data = data.data;
                    var userInfo = "";
                    userInfo +=
                            "<div class='weui-cells'>" +
                            "<div class='top'>" +
                            "<div class='weui-media-box__hd avatar' style='padding: 10px'>" +
                            "<a href='/stock/userCenter'>" +
                            "<img class='weui-media-box__thumb' src=" + data.headimgurl + ">" +
                            "</a>" +
                            "</div>" +
                            "<div class='weui-media-box__bd name'>" +
                            "<h4 class='weui-media-box__title'>名字：" + data.nickname + "</h4>" +
                            "<h4 class='weui-media-box__title'>用户组别名称：" + "cateName" + "</h4>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "<div class='weui-cells'>" +
                            "<a class='weui-cell weui-cell_access' href='/categories'>" +
                            "<div class='weui-cell__hd'><img src='images/category.png'></div>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>类别管理</p>" +
                            "</div>" +
                            "<div class='weui-cell__ft'>" +
                            "</div>" +
                            "</a>" +
                            "<a class='weui-cell weui-cell_access' href='/sellers'>" +
                            "<div class='weui-cell__hd'><img src='images/seller.png'></div>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>供应商管理</p>" +
                            "</div>" +
                            "<div class='weui-cell__ft'>" +
                            "</div>" +
                            "</a>" +
                            "<a class='weui-cell weui-cell_access' href='/depots'>" +
                            "<div class='weui-cell__hd'><img src='images/order_depot.png'></div>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>仓库管理</p>" +
                            "</div>" +
                            "<div class='weui-cell__ft'>" +
                            "</div>" +
                            "</a>" +
                            "<a class='weui-cell weui-cell_access' href='/purchases'>" +
                            "<div class='weui-cell__hd'><img src='images/purchase_record.png'></div>" +
                            "<div class='weui-cell__bd'>" +
                            "<p>进货记录</p>" +
                            "</div>" +
                            "<div class='weui-cell__ft'>" +
                            "</div>" +
                            "</a>" +
                            "</div>";
                    $("#userInfo").html(userInfo);
                },
                error: function(data){
                    console.log(data);
//                    alert(data);
                    if (result.code == 2002) login();
                }
            });
        });
//        function login() {
//            window.location.href = "http://" + domain + "/api/v1/login?url=http://" + domain + "/";
////        window.location.href = "http://" + domain + "/api/wechat/v1/test_login?url=http://" + domain + "/wechat";
//        }
    </script>
@stop