{!! Rapyd::head() !!}
@section('title','供销商列表')
    <h1>供销商列表</h1>

    <div class="pull-right" style="margin-bottom: 15px">{!! $filter !!}</div>
    <p>
        {!! $grid !!}
    </p>

