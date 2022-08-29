@extends('cluster.main')

@section('content')

    <div class="wb-undersort-index" id="main_content_wrapper">

        @parent

        <div class="row">

            <div class="col-md-12">
                <a href="{{ route('wb.undersort_run') }}">
                    <button class="btn btn-primary btn-block" style="text-align: center; margin-bottom: 10px;">
                        Расчитать подсортировку
                    </button>
                </a>
            </div>

        </div>

        <h2>Готовые подсортировки</h2>

        @foreach( $undersorts_collection as $item)


            <?php /** @var $item \App\Models\WBParser\WBUndersort */ ?>

            <div class="panel panel-info" style="margin-bottom: 15px">
                <div class="panel-heading">
                    {{$item->getTitle()}}
                </div>
                <div class="panel-body">

                    <a href="{{ route('wb.undersort_item', $item->getId()) }}">
                        Страница товаров -->
                    </a>

                    @if($item->getXmlPath())

                        <b style="display: block; margin: 10px 0">Скачать XML:</b>

                        <a href="{{$item->getXmlPath()}}"
                           download
                           target="_blank">
                            <button class="btn btn-success btn-block">
                                <small>{{$item->getTitle()}}</small>
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

                            <a href="{{ route('wb.undersort_index', 'undersort_xml_start=1&undersort_id=' . $item->getId()) }}">
                                <button class="btn btn-warning btn-block">
                                    (Не выгружен) <small>{{$item->getTitle()}}</small>
                                </button>
                            </a>

                        @endif

                    @endif

                </div>
            </div>

        @endforeach

        <div class="row">
            <div class="col-md-12">

                {{ $undersorts_collection->links('cluster.components.pagination.pagination') }}

            </div>
        </div>

    </div>

@endsection

@section('page_scripts')

    <script>

    </script>

@stop
