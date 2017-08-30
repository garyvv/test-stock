@extends('Vicky.layout')

<link href="{{ URL::asset('/vicky/css/index.css') }}" rel="stylesheet" type="text/css"/>

<script type="text/javascript"
        src="{{ URL::asset('/vicky/js/index.js') }}"></script>
@section('content')
    <div id="photo">
    </div>

    <div class="loadmore" style="display: none;">
        <i class="loading"></i>
        <span class="loadmore-tips">正在加载</span>
    </div>

    <script>
        var loading = false;  //状态标记
        var page = 1;//声明页码的全局变量
        var data = {};

        $(document).ready(function () {
            var url = API_INDEX;
            var method = "get";
            $.ajax({
                url: url,
                type: method,
                data: {},
                dataType: "json",
                success: function (data) {
                    var result = data.data.data;
                    genPhotoHtml(result);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });


        $(window).scroll(function () {
            var winH = $(window).height(),
                bodyH = $("body").height(),
                scrollTop = $(document).scrollTop();
            //下面的1是距离底部只有1px的意思，可根据个人需要修改
            if ((bodyH + scrollTop) / winH > 0.96) {
                if (loading) return;
                loading = true;
                page = parseInt(page) + 1;
                console.log(page);
                var url = API_INDEX + "?page=" + page;
                var method = "get";

                data.per_page = 20;
                $.ajax({
                    url: url,
                    type: method,     //请求类型
                    data: data,  //请求的数据
                    dataType: "json",  //数据类型
                    success: function (data) {
                        var result = data.data.data;
                        setTimeout(function () {
                            genPhotoHtml(result);
                            loading = false;
                        }, 1500)
                    },
                    error: function (data) {
                        console.log(data.msg);
                    }
                })
            } else {
                return false;
            }
        });

    </script>
@stop