@extends('admin.index')
<link href="{{ URL::asset('/css/redis.css') }}" rel="stylesheet" type="text/css"/>
@section('content')
    <h3 style="margin-top: 0;margin-left:20px; padding-top: 20px">Redis列表</h3>
    <div class="body-content">
        <h5>显示前100个</h5>
        @foreach($list as $key => $item)
            <li>
                <a href="/admin/redis/detail/{{ $item }}/config/{{ $config }}">{{ $item }}</a>
            </li>
        @endforeach
    </div>
@endsection
