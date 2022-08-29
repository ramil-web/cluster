@extends('cluster.main')

@section('content')

    <div class="wb-index" id="main_content_wrapper">

        @parent

        <div class="row">

            <div class="col-md-12">

                <h1 class="main-title">WB Analytics</h1>

            </div>

        </div>

        {{--<div class="row" style="margin-bottom: 20px">--}}

        {{--<div class="col-md-12">--}}

        {{--<div class="btn-group">--}}
        {{--<button type="button" class="btn btn-default">--}}
        {{--<a href="{{ route('wb.analytics') }}">--}}
        {{--Аналитика--}}
        {{--</a>--}}
        {{--</button>--}}
        {{--</div>--}}

        {{--</div>--}}

        {{--</div>--}}
        <wb_base_product :base_product="{{ json_encode($base_product) }}"
                         :wb_products_group_by_warehouse="{{ json_encode($wb_products_group_by_warehouse) }}"
                         :sales_diagram_collections="{{ json_encode($sales_diagram_collections) }}"
        ></wb_base_product>

        {{--        {{dd($base_product)}}--}}
        {{--        {{dd($wb_products)}}--}}

        <div class="row">

            <div class="col-md-12">


            </div>

        </div>

    </div>

@endsection

@section('page_scripts')

    <script>

    </script>

@stop
