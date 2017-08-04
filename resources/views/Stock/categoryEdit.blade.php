<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ URL::asset('/weui/dist/lib/weui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/weui/dist/css/jquery-weui.min.css') }}" rel="stylesheet" type="text/css" />
    <title>inventory</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>

<body>
<form>
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" id="category_id" name="category_id" value="{{$detail->category_id}}"/>
    {{--<a href="javascript:;" class="weui-btn weui-btn_plain-default">按钮</a>--}}
    {{--<a href="javascript:;" class="weui-btn weui-btn_primary">按钮</a>--}}
    {{--<a href="javascript:;" class="weui-btn weui-btn_warn">确认</a>--}}
    <div class="weui-cells weui-cells_form">
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    名称：
                    <input class="weui-input" type="text" id="name" name="name" placeholder="请输入类别名称" value="{{$detail->name}}">
                </div>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    供应商：
                    <select id = 'seller_id' name="seller_id">
                        @foreach($sellers as $seller)
                            <option value="{{$seller->seller_id}}" @if($detail->seller_id == $seller->seller_id) selected = "selected" @endif>{{$seller->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    存放仓库：
                    <select id = 'depot_id' name="depot_id">
                        @foreach($depots as $depot)
                            <option value="{{$depot->depot_id}}" @if($detail->depot_id == $depot->depot_id) selected = "selected" @endif>{{$depot->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    批发价：
                    <input class="weui-input" type="text" id="wholesale_price" name="wholesale_price" placeholder="请输入批发售价" value="{{$detail->wholesale_price}}">
                </div>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>零售价：</p>
                    <input class="weui-input" type="text" id="retail_price" name="retail_price" placeholder="请输入零售价格" value="{{$detail->retail_price}}">
                </div>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>入货价：</p>
                    <input class="weui-input" type="text" id="purchasing_price" name="purchasing_price" placeholder="请输入入货价格" value="{{$detail->purchasing_price}}">
                </div>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>会员价：</p>
                    <input class="weui-input" type="text" id="vip_price" name="vip_price" placeholder="请输入会员价格" value="{{$detail->vip_price}}">
                </div>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>类别规格：</p>
                    <input class="weui-input" type="text" id="option_name" name="option_name" placeholder="请输入类别规格" value="{{$detail->option_name}}">
                </div>
            </div>
        </div>
        <input type="button" class="weui-btn weui-btn_primary" id="submit" onclick="updateCategory()" value="提交">
    </div>
</form>
</body>
<script>
    function updateCategory(){
        var url = API_CATEGORY_UPDATE + "{{$detail->category_id}}";
        var data ={};
        data.name = $('#name').val();
        data.category_id = $('#category_id').val();
        data.seller_id = $('#seller_id').val();
        data.depot_id = $('#depot_id').val();
        data.wholesale_price = $('#wholesale_price').val();
        data.retail_price = $('#retail_price').val();
        data.purchasing_price = $('#purchasing_price').val();
        data.vip_price = $('#vip_price').val();
        data.option_name = $('#option_name').val();
        var method = "post";
        $.ajax({
            url: url,
            type: method,     //请求类型
            data: data,  //请求的数据
            dataType: "json",  //数据类型
            success: function (data) {
                $.toast(data.msg);
            },
            error: function (data) {
            },
        })

    }
</script>
<script type="text/javascript"
        src="{{ URL::asset('/weui/dist/lib/jquery-2.1.4.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/js/common.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/js/routes.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/weui/dist/js/jquery-weui.min.js') }}"></script>
</html>