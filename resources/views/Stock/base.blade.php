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

</html>