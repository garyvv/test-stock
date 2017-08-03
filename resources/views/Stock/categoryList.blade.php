<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ URL::asset('/weui/dist/lib/weui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/weui/dist/css/jquery-weui.min.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript"
            src="{{ URL::asset('/weui/dist/lib/jquery-2.1.4.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('/weui/dist/js/jquery-weui.min.js') }}"></script>
    <title>库存管理</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<style>
    .images{
        width:80px;
    }
</style>
<body>

<div class="weui-cells">
    @foreach ($cateLists as $cateList)
    <a href="{{ url('/categories') }}/{{$cateList->category_id}}">
        <div class="weui-cell">
            {{--<div class="weui-cell__hd"><img src=""></div>--}}
            <div class="weui-cell__bd">
                <p>ID：{{$cateList->category_id}}</p>
                <p>名称：{{$cateList->name}}</p>
                <p>仓库：{{$cateList->depot_name}}</p>
                <p>零售价：￥{{$cateList->retail_price}}</p>
                <p>规格：{{$cateList->option_name}}</p>
            </div>
            <div class="weui-cell__ft"><img class="images" src="../images/avatar.jpg"></div>
        </div>
    </a>
    @endforeach

    <a href="{{ url('/stock/categories') }}">
        <div class="weui-cell">
            {{--<div class="weui-cell__hd"></div>--}}
            <div class="weui-cell__bd">
                <p>类别名称</p>
            </div>
            <div class="weui-cell__ft"><img class="images" src="../images/avatar.jpg"></div>
        </div>
    </a>

</div>

</body>
</html>