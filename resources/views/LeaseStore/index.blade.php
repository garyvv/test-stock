@extends('LeaseStore.layout')
@section('content')

<div class="page">
    <div class="page__hd">
        <h1 class="page__title">商品列表</h1>
        <p class="page__desc"></p>
    </div>
    <div class="weui-grids">
	@foreach ($products as $product)
        <a href="{{ URL::asset('lease/products/' . $product->id) }}" class="weui-grid">
            <div class="weui-grid__icon">
                <img src="storage/{{ $product->image }}" alt="">
            </div>
            <p class="weui-grid__label">{{ $product->name }}</p>
        </a>
	@endforeach

    </div>
</div>




                <div class="page__category js_categoryInner">
                    <div class="weui-cells page__category-content">
                        <a class="weui-cell weui-cell_access js_item" data-id="button" href="javascript:;">
                            <div class="weui-cell__bd">
                                <p>Button</p>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </a>
                        <a class="weui-cell weui-cell_access js_item" data-id="input" href="javascript:;">
                            <div class="weui-cell__bd">
                                <p>Input</p>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </a>
                        <a class="weui-cell weui-cell_access js_item" data-id="list" href="javascript:;">
                            <div class="weui-cell__bd">
                                <p>List</p>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </a>
                        <a class="weui-cell weui-cell_access js_item" data-id="slider" href="javascript:;">
                            <div class="weui-cell__bd">
                                <p>Slider</p>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </a>
                        <a class="weui-cell weui-cell_access js_item" data-id="uploader" href="javascript:;">
                            <div class="weui-cell__bd">
                                <p>Uploader</p>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </a>
                    </div>
                </div>

@stop
