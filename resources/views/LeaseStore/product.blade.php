@extends('LeaseStore.layout')
@section('content')

<article class="weui_article">
    <section>
        <img src='{{ URL::asset("storage/" . $product->image) }}' style='width:100%;height:150px' ></img>
        <h2 class="title">{{ $product->name  }}</h2>
        <section style="width:100%;overflow:hidden">
                <p>{!! $product->description !!}</p>
        </section>
        <section>
            <h3>1.2 节标题</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </section>
    </section>
</article>
@stop
