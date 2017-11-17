@extends('Stock.base')
@section('content')

    <div id="depotDetail">
        //detail加载位置

    </div>
    <script>
        var token = getCookie('token');

        $(document).ready(function () {
            var url = API_DEPOT_URL + "/" + "{{$did}}" + "/form";
            var method = "get";
            var data = {};
            $.ajax({
                headers:{
                    token:token
                },
                url: url,
                type: method,
                data: data,
                dataType: "json",
                success: function (data) {
                    var data = data.data;
                    var depotDetail = "";
                    depotDetail +=
                            "<form>" +
                            "<input type='hidden' id='depot_id' name='depot_id' value='" + data.depot_id + "'/>" +
                            "<div class='weui-cells weui-cells_form'>" +
                                "<div class='weui-cell'>"+
                                    "<div class='weui-cell__hd'>" +
                                        "<label class='weui-label'>" +
                                                "仓库名称:" +
                                        "</label>" +
                                    "</div>"+
                                    "<div class='weui-cell__bd'>" +
                                        "<input class='weui-input' type='text' id='name' name='name' placeholder='请输入仓库名称' value='" + data.name + "'>" +
                                    "</div>" +
                                "</div>"+
                            "</div>" +
                            "<input type='button' class='weui-btn weui-btn_primary' id='submit' onclick='edit()' value='提交'>" +
                            "</form>";
                    $("#depotDetail").html(depotDetail);
                },
                error: function () {

                }
            })
        })

        function edit() {
            var url = API_DEPOT_URL + "/{{$did}}";
            var data = {};
            data.depot_id = $('#depot_id').val();
            data.name = $('#name').val();
            var method = "put";
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
                        window.location.href = "/depots/" + data.data.depot_id;
//                    console.log(data.data.category_id);
                    });
                },
                error: function (data) {
                },
            })

        }
    </script>
@stop