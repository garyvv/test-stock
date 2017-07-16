@extends('admin.index')
@section('content')
    {!! Rapyd::head() !!}
    <div style="padding:2%">
        <div class="pull-right" style="margin-bottom: 15px">
            {!! $filter !!}
        </div>
        <br>
        <hr>
        {!! $grid !!}
    </div>
@endsection
