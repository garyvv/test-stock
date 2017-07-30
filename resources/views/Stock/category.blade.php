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
    <title>inventory</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<style>
    .images{
        width:80px;
    }
</style>
<body>
<div class="weui-search-bar" id="searchBar">
    <form class="weui-search-bar__form">
        <div class="weui-search-bar__box">
            <i class="weui-icon-search"></i>
            <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required="">
            <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
        </div>
        <label class="weui-search-bar__label" id="searchText">
            <i class="weui-icon-search"></i>
            <span>搜索</span>
        </label>
    </form>
    <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
</div>

<div class="weui-cells">

    <a href="{{ url('/stock/categoryDetail') }}">
        <div class="weui-cell">
            {{--<div class="weui-cell__hd"><img src=""></div>--}}
            <div class="weui-cell__bd">
                <p>类别名称</p>
            </div>
            <div class="weui-cell__ft"><img class="images" src="../images/avatar.jpg"></div>
        </div>
    </a>
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