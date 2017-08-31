<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ URL::asset('/vicky/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <script type="text/javascript"
            src="{{ URL::asset('/weui/dist/lib/jquery-2.1.4.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('/vicky/js/routes.js') }}"></script>
    <title>Vicky</title>
    <!-- Fonts -->
</head>
@extends('Vicky.header')

<body>

@yield('content')

@extends('Vicky.footer')
</body>

<script>
    var domain = "stock.local.com"; // 本地调试域名
    //    var domain = "xn--xwtv59b.xn--6qq986b3xl"; // 服务器正式域名

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
                        break;
                }
            }
        );
    });
</script>

</html>
