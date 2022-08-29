@extends('cluster.main')

@section('content')

    <div class="wb-undersort-index" id="main_content_wrapper">

        @parent

        <wb_undersort></wb_undersort>

        @if($show_items)

            @if($undersort_main_running)
                <div class="panel panel-danger" style="margin-top: 15px">
                    <div class="panel-heading" style="text-align: center">
                        Идет создание подсортировки &nbsp;&nbsp;

                        <i class="fa fa-spinner fa-spin"></i>
                    </div>
                </div>
            @else
                <div class="panel panel-info" style="margin-top: 15px">
                    <div class="panel-heading">Создать подсортировку ({{$base_date_start}} - {{$base_date_end}})</div>
                    <div class="panel-body">

                        <a href="/undersort/run?undersort_start=1&date_start={{$base_date_start}}&date_end={{$base_date_end}}">
                            <button class="btn btn-success btn-block">
                                Создать подсортировку
                            </button>
                        </a>

                    </div>
                </div>
            @endif

            <div class="row">

                <div class="col-md-12">
                    <h2>
                        Дата начала
                        <small>(включительно)</small>
                        - {{$base_date_start}}; Дата окончания
                        <small>(включительно)</small>
                        - {{$base_date_end}};
                    </h2>

                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#under_inf" style="margin-bottom: 10px">
                        Формулы расчета
                    </button>
                    <div id="under_inf" class="collapse" style="border: 1px solid #ccc; padding: 10px; background-color: beige;">
                        <b class="text-danger">Базовый период : URL(?date_start={{$base_date_start}}
                            &date_end={{$base_date_end}})</b><br>
                        <b class="text-danger">Кол-во дней до следующей подсортировки
                            <small class="text-primary">(a7)</small>
                            : 14</b><br>
                        <b class="text-danger">Дни товара в пути
                            <small class="text-primary">(a9)</small>
                            : 10</b><br>
                        <b class="text-danger">Конверсия
                            <small class="text-primary">(a8)</small>
                            : 0.3</b>
                        <br>
                        <hr>
                        <b class="text-success">
                            Товар к подсортировке = Потребность в товаре - Расчетный остаток
                        </b>
                        <hr>
                        <b class="text-success">
                            Расчетный остаток
                            <small class="text-primary">(a1)</small>
                            = Остаток доступный к заказу + товар в пути ОТ клиента + товар
                            в пути к клиенту * (1-0,6), где 0,6 - константа (максимальное из наиболее вероятных по
                            длительному
                            периоду наблюдений значение конверсии)
                        </b>
                        <hr>
                        <b class="text-success">
                            Потребность в товаре = Заказ за базовый период
                            <small class="text-primary">(a3)</small>
                            / Количество дней представления на сайте в базовом периоде
                            <small class="text-primary">(a2)</small>
                            * Количество дней до следующей подсортировки
                            <small class="text-primary">(a7)</small>
                            *Конверсия (за длительный период, сейчас беру год и ограничиваю значение 1)
                            <small class="text-primary">(a8)</small>
                            * 2 + Заказ за базовый период
                            <small class="text-primary">(a3)</small>
                            /количество дней представления на сайте в базовом периоде
                            <small class="text-primary">(a2)</small>
                            * 10 (дни товара в пути)
                            <small class="text-primary">(a9)</small>
                            * (1- конверсия
                            <small class="text-primary">(a8)</small>
                            (но не более 1))
                        </b>
                        <hr>
                        <b class="text-primary">
                            Потребность в товаре = (((a3)/(a2)) * (a7) * (a8) * 2) + (((a3)/(a2)) * (a9) * (1- (a8))))
                        </b>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px">

                    @foreach( $base_products as $base_product)
                        <?php /** @var \App\Models\WBParser\WBBaseProduct $base_product */ ?>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                @if($base_product->c_product)

                                    <a href="{{ route('wb.base_item', $base_product->getNmId()) }}">
                                        {{ $base_product->c_product->full_title }}
                                    </a>

                                @else

                                    <a href="{{ route('wb.base_item', $base_product->getNmId()) }}">
                                        {{ $base_product->getSubject() }}  {{ $base_product->getSupplierArticle() }}
                                    </a>

                                @endif
                            </div>
                            <div class="panel-body">

                                @if($base_product->wb_products)
                                    <table class="table table-bordered">

                                        <thead>
                                        <tr>
                                            <th>WB ID</th>
                                            <th>Размер</th>
                                            <th>Склад</th>
                                            <th>Расч. остаток
                                                <small class="text-primary">(a1)</small>
                                            </th>
                                            <th>Кол.во дней на сайте(б\п)
                                                <small class="text-primary">(a2)</small>
                                            </th>
                                            <th>Заказы за баз.\период
                                                <small class="text-primary">(a3)</small>
                                            </th>
                                            <th>Продажи за (б\п)
                                                <small class="text-primary">(a4)</small>
                                            </th>
                                            <th>(a3)/(a2)
                                                <small class="text-primary">(a5)</small>
                                            </th>
                                            <th>Конверсия</th>
                                            {{--<th>(a4)/(a2)<small class="text-primary">(a6)</small></th>--}}
                                            <th>Потребность в товаре
                                                <small class="text-primary">(a10)</small>
                                            </th>
                                            <th>Товар к подсортировке (a10)-(a1)</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @foreach( $base_product->wb_products as $wb_product)
                                            <?php /** @var \App\Models\WBParser\WBProduct $wb_product */ ?>
                                            <?php $undersort_data = $wb_product->getUndersortData(); ?>
                                            <tr>
                                                <td>{{ $wb_product->getNmId()}}</td>
                                                <td>{{ $wb_product->getTechSize()}}</td>
                                                <td>{{ $wb_product->getWarehouseName() }}</td>
                                                <td>{{ $undersort_data->get('estimated_balance') }}</td>
                                                <td>{{$undersort_data->get('parse_days_on_site')}}</td>

                                                <td>
                                                    <b>Всего {{$undersort_data->get('wb_orders')->count()}} шт.</b>

                                                    @foreach( $undersort_data->get('orders_group') as $key => $item)
                                                        <small>({{$key}} - {{$item->count()}} шт.),</small>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    <b>Всего {{$undersort_data->get('wb_sales')->count()}} шт.</b>

                                                    @foreach( $undersort_data->get('sales_group') as $key => $item)
                                                        <small>({{$key}} - {{$item->count()}} шт.),</small>
                                                    @endforeach
                                                </td>

                                                <td>{{$wb_product->getConversion()}}</td>
                                                <td>{{$undersort_data->get('orders_days_dif')}}</td>
                                                {{--                                            <td>{{$undersort_data->get('sales_days_dif')}}</td>--}}

                                                <td>{{$undersort_data->get('product_need')}}</td>
                                                <td>{{$undersort_data->get('undersort_count')}}</td>

                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                @else

                                @endif

                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

            {{ $base_products->appends(request()->except('page'))->links('cluster.components.pagination.pagination') }}

        @endif

    </div>

@endsection

@section('page_scripts')

    <script>

    </script>

@stop
