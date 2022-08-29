<div class="row" style="border: 1px solid #000">
    <div class="col-md-12">
        <h1>Сайдбар</h1>

        @if ($page->page_sidebars)

            @foreach ($page->page_sidebars as $item)
                {{$item->name}}
                <br>
            @endforeach

        @endif

    </div>
</div>