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
<form name="category" method="post" action="{{url('/categoryUpdate')}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" name="category_id" value="{{$detail->category_id}}"/>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>名称：</p>
                <input class="weui-input" type="text" name="name" placeholder="请输入类别名称" value="{{$detail->name}}">
                <p>供应商：</p>
                <select id = 'seller' name="seller_id">
                    @foreach($sellers as $seller)
                    <option value="{{$seller->seller_id}}" @if($detail->seller_id == $seller->seller_id) selected = "selected" @endif>{{$seller->name}}</option>
                    @endforeach
                </select>
                <p>存放仓库：</p>
                <select id = 'depot' name="depot_id">
                    @foreach($depots as $depot)
                        <option value="{{$depot->depot_id}}" @if($detail->depot_id == $depot->depot_id) selected = "selected" @endif>{{$depot->name}}</option>
                    @endforeach
                </select>
                <p>批发价：</p>
                <input class="weui-input" type="text" name="wholesale_price" placeholder="请输入批发售价" value="{{$detail->wholesale_price}}">
                <p>零售价：</p>
                <input class="weui-input" type="text" name="retail_price" placeholder="请输入零售价格" value="{{$detail->retail_price}}">
                <p>入货价：</p>
                <input class="weui-input" type="text" name="purchasing_price" placeholder="请输入入货价格" value="{{$detail->purchasing_price}}">
                <p>会员价：</p>
                <input class="weui-input" type="text" name="vip_price" placeholder="请输入会员价格" value="{{$detail->vip_price}}">
                <p>类别规格：</p>
                <input class="weui-input" type="text" name="option_name" placeholder="请输入类别规格" value="{{$detail->option_name}}">
                <input type="submit" value="提交">
            </div>

        </div>
    </div>
</form>
</body>
</html>