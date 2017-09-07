@extends('Stock.base')
@section('content')

    <div id="depotDetail">
        {{--detail加载位置--}}

    </div>
    <script>
        var token = getCookie('token');

        $(document).ready(function () {
            var depotDetail = "";
            depotDetail +=
                    "<form>" +
                    "<div class='weui-cells weui-cells_form'>" +
                        "<div class='weui-cell'>"+
                            "<div class='weui-cell__hd'>" +
                                "<label class='weui-label'>" +
                                        "仓库名称:" +
                                "</label>" +
                            "</div>"+
                            "<div class='weui-cell__bd'>" +
                                "<input class='weui-input' type='text' id='name' name='name' placeholder='请输入仓库名称' value=''>" +
                            "</div>" +
                        "</div>"+
                    "</div>" +
                    "<input type='button' class='weui-btn weui-btn_primary' id='submit' onclick='createDepot()' value='提交'>" +
                    "</form>";
            $("#depotDetail").html(depotDetail);
        });

        function createDepot() {
            var data = {};
            data.name = $('#name').val();
            var url = API_DEPOT_URL + "/create";
            var method = "post";
            $.ajax({
                headers:{
                    token:token
                },
                url: url,
                type: method,     //请求类型
                data: data,  //请求的数据
                dataType: "json",  //数据类型
                success: function (data) {
                    $.toast(data.msg, function () {
                        window.location.href = "/depots";
//                    console.log(data.data.category_id);
                    });
                },
                error: function (data) {
                },
            })

        }
    </script>
@stop