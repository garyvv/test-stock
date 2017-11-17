@extends('admin.index')
@section('content')
    {!! Rapyd::head() !!}
    <div style="padding:2%">
        <div class="rpd-edit">
            {!! $edit !!}
        </div>
    </div>

    <script>
        var images = new Array();
        @foreach(explode(',', $edit->model->image) as $key => $item)
            @if($item) images[{!! $key !!}] = '{!! $item !!}'; @endif
        @endforeach
        console.log(images);
        ossImage('div_image', 'image', '/admin/vicky/oss/home', images)
    </script>
@endsection
