<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ URL::asset('/weui/dist/lib/weui.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('/weui/dist/css/jquery-weui.min.css') }}" rel="stylesheet" type="text/css"/>
    <script type="text/javascript"
            src="{{ URL::asset('/weui/dist/lib/jquery-2.1.4.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('/js/routes.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('/js/common.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('/weui/dist/js/jquery-weui.min.js') }}"></script>
    <title>库存管理</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>

<body>

@yield('content')

@extends('Stock.footer')
</body>

<script>
    var domain = "inventory.local.com";

    function login() {
        window.location.href = "http://" + domain + "/api/v1/login?url=http://" + domain + "/";
//        window.location.href = "http://" + domain + "/api/v1/test_login/1?url=http://" + domain + "/";
    }

    $(function () {
        //.ajaxError事件定位到document对象，文档内所有元素发生ajax请求异常，都将冒泡到document对象的ajaxError事件执行处理
        $(document).ajaxError(
            //所有ajax请求异常的统一处理函数，处理
            function (event, xhr, options, exc) {
                if (xhr.status == 'undefined') {
                    return;
                }
                console.log(xhr.responseJSON);
                var result = xhr.responseJSON;

                switch (xhr.status) {
                    case 404:
                        alert("您访问的资源不存在。");
                        break;

                    default:
//                        alert(result.msg);
                        if (result.code == 2002) login();
                        break;
                }
            }
        );
    });
</script>

</html>