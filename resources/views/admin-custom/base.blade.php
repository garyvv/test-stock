<style>
    .info-box{
        cursor: pointer;
    }
    .info-box:hover{
        background-color: #f5f5f5;
        width: 95%;
    }
</style>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" onclick="location='/admin/customers'">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">用户数量</span>
                <span class="info-box-number">{{$data['user_count']}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" onclick="location='/admin/orders'">
            <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">订单数量</span>
                <span class="info-box-number">{{$data['order_count']}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" onclick="location='/admin/sellers'">
            <span class="info-box-icon bg-yellow"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">商家数量</span>
                <span class="info-box-number">{{$data['seller_count']}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" onclick="location='/admin/categories'">
            <span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">商品数量</span>
                <span class="info-box-number">{{$data['product_count']}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>