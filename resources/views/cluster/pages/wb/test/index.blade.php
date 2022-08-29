@extends('cluster.main')

@section('content')

    <div class="wb-index" id="main_content_wrapper">

        @parent

        <div class="row">

            <div class="col-md-12">

                <h2>Выборка заказов/продаж c {{$date_start . ' по ' . $date_end}}</h2>

            </div>

        </div>

        <wb_date_range_vue :url="'test_index'"></wb_date_range_vue>

        <div class="row">

            <div class="col-md-6">

                @foreach( $grouped_orders_brands as $key => $items)

                    <div class="panel panel-default">
                        <div class="panel-heading">{{$key}}  шт.<br><b class="text-primary">Дата -- Кол-во заказов</b></div>
                        <div class="panel-body" >

                                <div class="row">

                                    @foreach( $items as $key2 => $orders_gr)
                                        <div class="col-md-12">
                                            <b class="text-danger">
                                                {{$key2}} --
                                                {{$orders_gr->count()}} шт.
                                            </b>
                                        </div>
                                    @endforeach

                                </div>

                        </div>
                    </div>

                @endforeach

            </div>

            <div class="col-md-6">

                @foreach( $grouped_sales_brands as $key => $items)

                    <div class="panel panel-default">
                        <div class="panel-heading">{{$key}}  шт.<br><b class="text-primary">Дата -- Кол-во продаж</b></div>
                        <div class="panel-body" >

                            <div class="row">

                                @foreach( $items as $key2 => $sales_gr)
                                    <div class="col-md-12">
                                        <b class="text-danger">
                                            {{$key2}} --
                                            {{$sales_gr->count()}} шт.
                                        </b>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>

                @endforeach

            </div>

        </div>

    </div>

@endsection

@section('page_scripts')

    <script>

    </script>

@stop
