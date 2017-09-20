@extends('Stock.base')
@section('content')

<style>
    .fr{
        float: right;
        margin-right: 10px;
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
        var url = API_DEPOT_URL + "/{{$did}}";
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
                    "<div class='fr'>"+
                    " <a href='javascript:;' class='weui-btn weui-btn_mini weui-btn_primary ' onclick='javacript:return deleteDepot()'>DELETE" +
                    "</a>"+
                    " <a href='/depots/" + data.depot_id + "/edit' class='weui-btn weui-btn_mini weui-btn_primary '>EDIT" +
                    "</a></div>";
                $("#depotDetail").html(depotDetail);
            },
            error: function (data) {
            },

        });
    })

    function deleteDepot()
    {
        var msg = "您真的确定要删除吗?";
        if (confirm(msg)==true)
        {
            var url = API_DEPOT_URL + "/{{$did}}";
            var data = {};
            var method = "delete";
            data.depot_id = "{{$did}}";
            $.ajax({
                headers:{
                    token : token
                },
                url:url,
                data:data,
                type:method,
                dataType:'json',
                success:function(data){
                    $.toast(data.msg, function () {
                        window.location.href = "/depots";
//                    console.log(data.data.category_id);
                    });
                },
                error:function(data){
                    $.toast(data.msg, function () {
                        window.location.href = "/depots";
                    });
                }
            });
        }
        else
        {
            return false;
        }
    }
</script>

@stop