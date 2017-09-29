@extends('admin.index')
<link href="{{ URL::asset('/css/redis.css') }}" rel="stylesheet" type="text/css"/>
@section('content')
    <button onclick="delKey()" class="btn btn-default" style="float: right;margin-top: 20px;margin-right: 20px">删除</button>
    <h3 style="margin-top: 0;margin-left:20px; padding-top: 20px">Redis详情</h3>
    <div class="body-content">
        <p>过期时间： {{ $detail['expire'] }}&emsp;&emsp;Type： {{ $detail['type'] }}</p>
        <p>Value： {{ json_decode(json_encode($detail['value']), true) }}</p>
    </div>

    <script>
        function delKey() {
            $.ajax({
                url: '/admin/redis/detail/{{ $key }}/config/{{ $config }}',
                type: 'delete',
                dataType: "json",
                success: function (data) {
                    console.log('success');
                    alert('删除成功');
                    history.go(-1);
                },
                error: function () {

                }
            })
        }
    </script>
@endsection
