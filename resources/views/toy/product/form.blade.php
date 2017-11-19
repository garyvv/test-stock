@extends('admin.index')
@section('content')
    {!! Rapyd::head() !!}
    <style>
        #div_style label{
            width: 100px;
        }
        #fg_categories label{
            margin-left: 30px;
            width: 120px;
        }
        input[type=checkbox] {
            margin-right: 5px;
        }
    </style>

    {{--百度 UEditor--}}
    {{--<script type="text/javascript" src="{{ asset ("/js/ueditor/ueditor.config.js") }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset ("/js/ueditor/ueditor.all.min.js") }}"></script>--}}

    {{--jQuery 轻量级redactor--}}
    {{--<link rel="stylesheet" href="{{ asset("/packages/zofe/rapyd/assets/redactor/css/redactor.css") }}">--}}
    {{--<script type="text/javascript" src="{{ asset ("/packages/zofe/rapyd/assets/redactor/jquery.browser.min.js") }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset ("/packages/zofe/rapyd/assets/redactor/redactor.js") }}"></script>--}}

    <link rel="stylesheet" href="{{ asset("/js/simditor/styles/simditor.css") }}">

    <script type="text/javascript" src="{{ asset ("/js/simditor/scripts/jquery.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset ("/js/simditor/scripts/module.js") }}"></script>
    <script type="text/javascript" src="{{ asset ("/js/simditor/scripts/hotkeys.js") }}"></script>
    <script type="text/javascript" src="{{ asset ("/js/simditor/scripts/uploader.js") }}"></script>
    <script type="text/javascript" src="{{ asset ("/js/simditor/scripts/simditor.js") }}"></script>

    <div style="padding:2%">
        <div class="rpd-edit">
            {!! $form !!}
        </div>
    </div>

    {{--<script type="text/javascript">--}}
        {{--$('#div_link').html('').attr("name","link");--}}
        {{--UE.getEditor("div_link");--}}
    {{--</script>--}}

    <script>
        var editor = new Simditor({
            textarea: $('#textbox')
        });
//            上传HTML
            var btn = '<br><button onclick="uploadHtml()" type="button" class="pull-left btn btn-primary">上传文章图片</button><br><hr>';
            $('#div_link').append(btn);

        function uploadHtml() {
//            loading
            var index = layer.load(0, {
                shade: [0.3,'#000']
            });
            var data = {
                'image_dir': '{!! $imageDir !!}',
                'content': $('#textbox').val(),
                'ajax': 1 // 标识是ajax请求，服务端才不会redirect
            };
            $.ajax({
                type: 'POST',
                url: '/admin/toy/products/html',
                data: data,
                dataType: "json",
                success: function (data) {
                    var content = data.data.content;
                    layer.alert('上传成功');
                    $('#textbox').val(content);
                    layer.close(index);
                },
                error: function (data) {
                    alert('上传失败，请重新上传');
                    layer.close(index);
                }
            });
        }

        var thumb = new Array();
        var images = new Array();
        ossImage('image', '/admin/oss/bucket/static-toy?prefix={{ $imageDir }}&model_id=image', thumb)
        ossImage('images', '/admin/oss/bucket/static-toy?prefix={{ $imageDir }}&model_id=images', images)
    </script>
@endsection
