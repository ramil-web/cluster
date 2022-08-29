<div class="row">    
    <div class="col-md-12">
        <div id="icons_group" class="well">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="icons_search">Название иконки</label>
                        <input type="email" class="form-control" id="icons_search" placeholder="Введите название">
                    </div>
                </div>
            </div>
            @foreach( $icons as $item)
                <a href="/admin/icons/{!! $item->id !!}/edit" target="_blank">
                    <button class="btn icon-button"
                            style="margin: 5px; padding: 5px; width: 80px; line-height: 1; overflow: hidden"
                            title="{!! $item->name !!}">
                        <img src="/{!! $item->image !!}" alt=""
                             style="width: 60px; 
                             height: 60px; 
                             margin: 0 auto 3px;                                                           
                             display: block;">
                        <b>
                            <small style="color: #c81919">{!! $item->name !!}</small>
                        </b>
                    </button>
                </a>
            @endforeach
        </div>
    </div>
</div>



