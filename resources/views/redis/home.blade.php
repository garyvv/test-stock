@extends('admin.index')
<link href="{{ URL::asset('/css/redis.css') }}" rel="stylesheet" type="text/css"/>
@section('content')
    <h3 style="margin-top: 0;margin-left:20px; padding-top: 20px">Redis列表</h3>
    <div class="searchbar" style="margin: 20px">
        <div class="input-group">
            <input type="text" id="keyword" class="form-control" placeholder="请输入搜索内容" onkeydown="onKeyDown(event)"/>
            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        </div>
    </div>
    <div class="body-content">
        <ol>
            @foreach($paginator->items() as $key => $item)
                <li>
                    <a href="/admin/redis/detail/{{ $item }}/config/{{ $config }}">{{ $item }}</a>
                </li>
            @endforeach
        </ol>

        {{ $paginator->render() }}

    </div>

    <script type="text/javascript">
        function onKeyDown(event) {
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if (e && e.keyCode == 27) { // 按 Esc
                //要做的事情
            }
            if (e && e.keyCode == 113) { // 按 F2
                //要做的事情
            }
            if (e && e.keyCode == 13) { // enter 键
                window.location.href='/admin/redis/home/{{ $config }}?keyword=' + $('#keyword').val();
            }

        }

    </script>
@endsection
