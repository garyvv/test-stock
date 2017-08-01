<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../weui/dist/style/weui.css" />
    <script type="text/javascript"
            src="{{ URL::asset('../weui/weui.min.css') }}"></script>
    {{--<script type="text/javascript"--}}
    {{--src="{{ URL::asset('/weui/weui.css') }}"></script>--}}
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
    <a href="{{ url('/categoryDetail') }}/{{$cateList->category_id}}">
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

    <a href="{{ url('/stock/categoryDetail') }}">
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