<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
<div>
    <p>用户昵称：{{ $info['nickname'] }}</p>
    <img src="{!! $info['headimgurl'] !!}" style="width: 80px">
    <p>地址：{{ $info['country'] }} {{ $info['province'] }} {{ $info['city'] }}</p>
</div>
</body>
</html>