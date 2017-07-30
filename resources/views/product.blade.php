@extends('voyager::master') 
@section('content')
<p style="text-align:center"> Hello World </p>
{!! Rapyd::head() !!}
    {!! $filter !!}
    {!! $grid !!}
@stop
