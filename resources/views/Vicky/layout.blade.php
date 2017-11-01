<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv=Content-Language content=zh-cn> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Vicky 庄琪 Gary 深冬 深冬工作室 VickyZhuang 琪琪 爱情 表白">
    <meta name="description" content="Vicky的礼物，记录我们一路的点点滴滴">
    <meta name="baidu-site-verification" content="SoaKvVgLHl" />
    <meta name="sogou_site_verification" content="LPI2ugdsAN"/>
    
    <title>Vicky 深冬工作室</title>`
    
    <link href="{{ URL::asset('/vicky/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <script type="text/javascript"
            src="{{ URL::asset('/weui/dist/lib/jquery-2.1.4.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('/vicky/js/routes.js') }}"></script>
</head>
@extends('Vicky.header')

<body>

@yield('content')

@extends('Vicky.footer')
</body>

<script>
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https'){
       bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
      }
      else{
      bp.src = 'http://push.zhanzhang.baidu.com/push.js';
      }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();

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
