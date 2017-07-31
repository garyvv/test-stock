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
    <title>详情页</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>

<body>
<div></div>
<a href="{{url('/categoryEdit')}}/{{$detail->category_id}}">
<div class="weui-msg">
    <div class="weui-msg__icon-area"></div>
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title"><img src="../images/avatar.jpg"></h2>
    </div>
</div>
</a>

<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>类别名称:{{$detail->name}}</p>
            <p>商品规格:{{$detail->option_name}}</p>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>入货价</p>
            <p>￥{{$detail->purchasing_price}}</p>
        </div>
        <div class="weui-cell__bd">
            <p>批发价</p>
            <p>￥{{$detail->wholesale_price}}</p>
        </div>
        <div class="weui-cell__bd">
            <p>零售价</p>
            <p>￥{{$detail->retail_price}}</p>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>总入货</p>
            <p>{{$detail->purchase_amount}}</p>
        </div>
        <div class="weui-cell__bd">
            <p>总销售</p>
            <p>{{$detail->selling_amount}}</p>
        </div>
        <div class="weui-cell__bd">
            <p>现库存</p>
            <p>{{$detail->inventory}}</p>
        </div>
    </div>
</div>
<div>
    <p>供应商：{{$detail->seller_name}}</p>
    <p>地址：{{$detail->address}}</p>
    <p>联系人：{{$detail->contact}}</p>
    <p>联系电话：{{$detail->phone}}</p>
</div>

</body>

</html>