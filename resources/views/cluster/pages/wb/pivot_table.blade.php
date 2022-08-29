@extends('cluster.main')

@section('content')

    <div class="wb-index" id="main_content_wrapper">

        @parent

        <div class="row">

            <div class="col-md-12">

                <h1 class="main-title">Pivot WB Analytics</h1>

            </div>

        </div>

        {{--<div class="row" style="margin-bottom: 10px">--}}
        {{--<div class="col-md-12">--}}
        {{--<b style="display: block; margin: 10px 0">Количество строк:</b>--}}
        {{--</div>--}}

        {{--<div class="col-md-12" style="margin-bottom: 10px">--}}
        {{--<div class="btn-group">--}}

        {{--<a href="{{ route('wb.test_index', 'limit=100') }}"--}}
        {{--class="btn btn-primary {{ $limit == 100 ? ' active ' : '' }}">100</a>--}}
        {{--<a href="{{ route('wb.test_index', 'limit=500') }}"--}}
        {{--class="btn btn-primary {{ $limit == 500 ? ' active ' : '' }}">500</a>--}}
        {{--<a href="{{ route('wb.test_index', 'limit=500') }}"--}}
        {{--class="btn btn-primary {{ $limit == 1000 ? ' active ' : '' }}">1000</a>--}}
        {{--<a href="{{ route('wb.test_index', 'limit=all') }}"--}}
        {{--class="btn btn-primary {{ $limit == 'all' ? ' active ' : '' }}">Все(макс = 2000)</a>--}}

        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        @if($wb_stock->count())

            <wb_pivot_table :wb_stock="{{json_encode($wb_stock->getCollection())}}"
                     :limit="{{json_encode($limit)}}"
                     :table="{{json_encode($table)}}"></wb_pivot_table>

            <div class="row">

                <div class="col-md-12">

                    {{ $wb_stock->appends(request()->except('page'))->links('cluster.components.pagination.pagination') }}

                </div>

            </div>

        @endif

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
