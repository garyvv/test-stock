@extends('Vicky.layout')

<link href="{{ URL::asset('/vicky/css/index.css') }}" rel="stylesheet" type="text/css"/>

<script type="text/javascript"
        src="{{ URL::asset('/vicky/js/index.js') }}"></script>
@section('content')
    <section>
        <div class="time-story">
        </div>

        <div class="like-story">
            <div class="content-block">
                <ul class="like-ul"> <img src="{{ URL::asset('/vicky/img/home/fenhong.jpg') }}" />
                    <p>粉红少女❤️</p>
                </ul>
                <ul class="like-ul"> <img src="{{ URL::asset('/vicky/img/home/xigua.jpeg') }}" />
                    <p>西瓜🍉</p>
                </ul>
                <ul class="like-ul"> <img src="{{ URL::asset('/vicky/img/home/xiong.jpeg') }}" />
                    <p>🐰 在哪里</p>
                </ul>
                <ul class="like-ul"> <img src="{{ URL::asset('/vicky/img/home/huajia.jpg') }}" />
                    <p>🤤 花甲</p>
                </ul>
                <ul class="like-ul"> <img src="{{ URL::asset('/vicky/img/home/xia.jpg') }}" />
                    <p>香香辣辣的虾😋</p>
                </ul>
            </div>
        </div>

        <div id="photo" class="content-block">
        </div>

        <div class="loadmore" style="display: none;">
            <i class="loading"></i>
            <span class="loadmore-tips">正在加载</span>
        </div>
    </section>


    <script>
        var loading = false;  //状态标记
        var end = false;  //状态标记,是否全部加载完毕
        var page = 1;//声明页码的全局变量
        var postData = {};

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
                if (end) return;
                loading = true;
                page = parseInt(page) + 1;
                console.log(page);
                var url = API_INDEX + "?page=" + page;
                var method = "get";

                postData.per_page = 20;
                $.ajax({
                    url: url,
                    type: method,     //请求类型
                    data: postData,  //请求的数据
                    dataType: "json",  //数据类型
                    success: function (data) {
                        var result = data.data.data;
                        if (page > data.data.last_page) {
                            end = true;
                        }
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