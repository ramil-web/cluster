@foreach ($page->content_blocks as $block)

    @if ($block->type == 'slider')
        <div class="row">
            <div class="col-sm-12 clearfix">

                <slider-1 :block="{{$block}}"></slider-1>

            </div>
        </div>
    @endif

    @if ($block->type == 'text')
        <div class="row">
            <div class="col-sm-12">
                {!! $block->content !!}
            </div>
        </div>
    @endif

    @if ($block->type == 'image')
        <div class="row mb15">
            <div class="col-sm-12">
                <img src="{!! $block->get_src() !!}" alt="img" style="max-width: 100%; display: block;">
            </div>
        </div>
    @endif

    @if ($block->type == 'image_text')
        <div class="row mb15">
           
              <div class="col-sm-12 clearfix">
                <img src="{!! $block->blc_image()->get_src() !!}" alt="img"
                     style="width: 37%; min-width: 235px; float: left; margin: 10px 10px 10px 0">
                {!! $block->blc_text()->content !!}
            </div>

        </div>
    @endif

    @if ($block->type == 'google_map')
        <div class="row mb15">
            {{--            {{dd($page->content_blocks)}}--}}

            <div class="col-sm-12 clearfix">
                <google-map :block="{{$block}}"></google-map>
            </div>

        </div>
    @endif

@endforeach
