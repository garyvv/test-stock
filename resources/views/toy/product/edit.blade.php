@extends('admin.index')
@section('content')
    {!! Rapyd::head() !!}
    <style>
        #div_style label{
            width: 100px;
        }
        #fg_tags label{
            margin-left: 30px;
            width: 120px;
        }
        input[type=checkbox] {
            margin-right: 5px;
        }
    </style>

    <div style="padding:2%">
        <div class="rpd-edit">
            {!! $edit !!}
        </div>
    </div>

    <script>

        var thumb =  new Array("{{ $edit->model->image }}");
        var images = new Array();
        @foreach($images as $key => $image)
            images[{{$key}}] = "{{ $image }}";
        @endforeach
        ossImage('image', '/admin/oss/bucket/static-toy?prefix={{ $imageDir }}&model_id=image', thumb)
        ossImage('images', '/admin/oss/bucket/static-toy?prefix={{ $imageDir }}&model_id=images', images)
    </script>
@endsection
