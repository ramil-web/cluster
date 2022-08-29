@extends('cluster.main')

@section('content')

    <div class="wb-index" id="main_content_wrapper">

        @parent

        <div class="row">

            <div class="col-md-12">

                <h1 class="main-title">WB Analytics</h1>

            </div>

        </div>

        <wb_all_sales_diagrams :wb_sales="{{json_encode($wb_sales) }}"></wb_all_sales_diagrams>

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
