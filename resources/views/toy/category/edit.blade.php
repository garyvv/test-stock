@extends('admin.index')
@section('content')
    {!! Rapyd::head() !!}
    <style>
        #div_style label{
            width: 100px;
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
        ossImage('image', '/admin/oss/bucket/static-toy?prefix={{ $imageDir }}&model_id=image', thumb)
    </script>
@endsection
