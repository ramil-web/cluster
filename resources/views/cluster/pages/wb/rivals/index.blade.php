@extends('cluster.main')

@section('content')

    <div class="wb-rival-index" id="main_content_wrapper">

        @parent

        <div class="row">

            <div class="col-md-12">

                <h1 class="main-title">WB RIVALS</h1>

            </div>

        </div>

        <wb_rivals :rivals_brands="{{ json_encode($rivals_brands) }}"
                   :rivals_items="{{ json_encode($rivals_items) }}"
                   :current_brand="{{ json_encode($current_brand) }}">

        </wb_rivals>

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
