@extends('cluster.main')

@section('content')

    <div class="wb-undersort-item" id="main_content_wrapper">

        @parent

        <h2>
            {{$undersort->getTitle()}}
        </h2>

        <div class="row">

            <div class="col-md-12">

                @if($undersort->getXmlPath())

                    <b style="display: block; margin: 10px 0">Скачать XML:</b>

                    <a href="{{$undersort->getXmlPath()}}"
                       download
                       target="_blank">
                        <button class="btn btn-success btn-block">
                            <small>{{$undersort->getTitle()}}</small>
                        </button>
                    </a>

                @else

                    @if($undersort_xml_running)

                        <div class="panel panel-danger" style="margin: 0; text-align: center">
                            <div class="panel-heading">
                                Запущен экспорт в XML &nbsp;&nbsp;

                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                        </div>

                    @else

                        <b style="display: block; margin: 10px 0">Выгрузить в XML:</b>

                        <a href="{{ route('wb.undersort_index', 'undersort_xml_start=1&undersort_id=' . $undersort->getId()) }}">
                            <button class="btn btn-warning btn-block">
                                (Не выгружен) <small>{{$undersort->getTitle()}}</small>
                            </button>
                        </a>

                    @endif

                @endif
            </div>

        </div>


        @if(1 && $undersort->wb_undersort_products)

            {{--<wb_undersort_item :undersort_products="{{json_encode($undersort->wb_undersort_products) }}"></wb_undersort_item>--}}
            <wb_undersort_item_vue :undersort_products="{{json_encode($undersort->wb_undersort_products) }}"></wb_undersort_item_vue>

        @endif

        @if(0 && $undersort->wb_undersort_products)

            <div class="row">
                <div class="col-md-12">
                    <b style="display: block; margin: 10px 0">Сортировка:</b>
                </div>

                <div class="col-md-12" style="margin-bottom: 10px">
                    <div class="btn-group">

                        <a href="{{ route('wb.undersort_item', $undersort->getId() . '?order_by=undersort_count') }}"
                           class="btn btn-primary {{ $order_by == 'undersort_count' ? ' active ' : '' }}">Подсорт</a>
                        <a href="{{ route('wb.undersort_item', $undersort->getId() . '?order_by=conversion') }}"
                           class="btn btn-primary {{ $order_by == 'conversion' ? ' active ' : '' }}">Конверсия</a>
                        <a href="{{ route('wb.undersort_item', $undersort->getId() . '?order_by=estimated_balance') }}"
                           class="btn btn-primary {{ $order_by == 'estimated_balance' ? ' active ' : '' }}">Остаток</a>
                        <a href="{{ route('wb.undersort_item', $undersort->getId() . '?order_by=days_on_site') }}"
                           class="btn btn-primary {{ $order_by == 'days_on_site' ? ' active ' : '' }}">Дней на сайте</a>
                        <a href="{{ route('wb.undersort_item', $undersort->getId() . '?order_by=orders') }}"
                           class="btn btn-primary {{ $order_by == 'orders' ? ' active ' : '' }}">Заказы за (б\п)</a>
                        <a href="{{ route('wb.undersort_item', $undersort->getId() . '?order_by=sales') }}"
                           class="btn btn-primary {{ $order_by == 'sales' ? ' active ' : '' }}">Продажи за (б\п)</a>

                    </div>
                </div>
            </div>

            <table class="table table-bordered">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Код WB</th>
                    <th>Штрих-код</th>
                    {{--<th>Склад</th>--}}
                    {{--<th>Артикул</th>--}}
                    <th>Размер</th>
                    <th>Конв (год)</th>
                    <th>Остаток</th>
                    <th>Дней на сайте(б\п)</th>
                    <th>Заказы за (б\п)</th>
                    <th>Продажи за (б\п)</th>
                    <th>Заказы за год</th>
                    <th>Продажи за год</th>
                    <th>Потребность</th>
                    <th>Подсорт</th>
                </tr>
                </thead>

                <tbody>

                @foreach( $undersort->wb_undersort_products as $key => $wb_undersort_product)
                    <?php /** @var $wb_undersort_product \App\Models\WBParser\WBUndersortProduct */ ?>

                    <tr>
                        <td>{{ $key + 1}}</td>
                        <td>{{ $wb_undersort_product->getNmId()}}</td>
                        <td>{{ $wb_undersort_product->getBarcode()}}</td>
                        {{--                        <td>{{ $wb_undersort_product->getWarehouseName()}}</td>--}}
                        {{--                        <td>{{ $wb_undersort_product->getSupplierArticle()}}</td>--}}
                        <td>{{ $wb_undersort_product->getTechSize()}}</td>
                        <td>{{ $wb_undersort_product->getConversion()}}</td>
                        <td>{{ $wb_undersort_product->getEstimatedBalance()}}</td>
                        <td>{{ $wb_undersort_product->getDaysOnSite()}}</td>
                        <td>{{ $wb_undersort_product->getOrders()}}</td>
                        <td>{{ $wb_undersort_product->getSales()}}</td>
                        <td>{{ $wb_undersort_product->getOrdersLastYear()}}</td>
                        <td>{{ $wb_undersort_product->getSalesLastYear()}}</td>
                        <td>{{ $wb_undersort_product->getProductNeed()}}</td>
                        <td>{{ $wb_undersort_product->getUndersortCount()}}</td>

                    </tr>

                @endforeach

                </tbody>
            </table>
        @else

            <h3>

            </h3>

        @endif


    </div>

@endsection


