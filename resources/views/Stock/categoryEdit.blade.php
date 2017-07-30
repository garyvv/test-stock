<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../weui/dist/style/weui.css" />
    <script type="text/javascript"
            src="{{ URL::asset('/weui/weui.min.css') }}"></script>
    {{--<script type="text/javascript"--}}
    {{--src="{{ URL::asset('/weui/weui.css') }}"></script>--}}
    <title>inventory</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>

<body>
<form name="category" method="post" action="{{url('/stock/categoryEdit')}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" name="id" value="1"/>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            {{--<div class="weui-cell__hd"><label class="weui-label">名称</label></div>--}}
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="name" placeholder="请输入类别名称">
                <input class="weui-input" type="select" name="seller_id" placeholder="请选择供应商">
                <input class="weui-input" type="text" name="depot_id" placeholder="请选择存放仓库">
                <input class="weui-input" type="text" name="wholesale_price" placeholder="请输入批发售价">
                <input class="weui-input" type="text" name="retail_price" placeholder="请输入零售价格">
                <input class="weui-input" type="text" name="purchasing_price" placeholder="请输入入货价格">
                <input class="weui-input" type="text" name="vip_price" placeholder="请输入会员价格">
                <input class="weui-input" type="text" name="option_name" placeholder="请输入类别规格">
                <input type="submit" value="提交">
            </div>

        </div>
    </div>
</form>
</body>
</html>