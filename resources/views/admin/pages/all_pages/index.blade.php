@extends('admin.layout')

@section('content')

    <div class="container main-content" id="main_cont" style="padding-bottom: 100px;">

        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-body">--}}
                {{--<h4>{{$page->id}} - {{$page->name}}</h4>--}}

                {{--<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">--}}
                    {{--Дебаг--}}
                {{--</a>--}}
                {{--<div class="collapse" id="collapseExample">--}}
                    {{--<div class="well">--}}
                        {{--{{dump($page)}}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {!!$page_blocks!!}

    </div>
@stop
