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

<body>
<a href="{{url('/stock/categoryEdit')}}">
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
            <p>标题文字</p>
        </div>
        <div class="weui-cell__ft">说明文字</div>
    </div>
</div>


</body>

</html>