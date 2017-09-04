@extends('Stock.base')
@section('content')

<style>
    .editButton
    {
        display: inline-block;
        border-radius: 14px;
        margin-top: 10px;
        margin-right: 20px;
        float: right;
    }
    .sellerTitle
    {
        text-align: center;;
    }
</style>
<div id="depotDetail">

</div>
<script>
    var token = getCookie('token');

    $(document).ready(function () {
        var url = API_DEPOT_URL + "/{{$did}}" + "/detail";
        {{--var url = "/api/v1/sellers" + "/{{$sid}}" + "/detail";--}}
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
                    "<h1 class='sellerTitle'>仓库信息</h1>"+
                    "<div class='weui-cells'>" +
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>ID: " + data.depot_id + "</p>" +
                            "</div>" +
                        "</div>" +
                        "<div class='weui-cell'>" +
                            "<div class='weui-cell__bd'>" +
                                "<p>仓库名称: " + data.name + "</p>" +
                            "</div>" +
                        "</div>"+
                    "</div>" +
                    " <a href='/depots/" + data.depot_id + "/edit' class='weui-btn weui-btn_primary editButton'>EDIT" +
                    "</a>"
                $("#depotDetail").html(depotDetail);
            },
            error: function (data) {
            },

        });
    })
</script>

@stop