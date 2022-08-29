{{--Скрытое поле icon_id добавляется в секции!!!--}}
<label class="control-label">Иконка</label>
<br>
<div class="row">
    <div class="col-md-12" style="margin-bottom: 15px">
        <div class="icons-wrap"
             style="padding: 10px; background-color: #ccc; width: 120px; height: 120px; margin: 0 auto">
            <img src="/{{$item_icon ? $item_icon->image : '' }}"
                 style="width: 100px; height: 100px;"
                 alt=""
                 id="icon_target"
            >          
        </div>
    </div>
    <div class="col-md-12" style="margin-bottom: 20px;">
        <button class="btn btn-primary btn-block"
                data-toggle="collapse"
                data-target="#icons_group"
                onclick="return false">
            Выбрать иконку
        </button>
    </div>
</div>
<div class="row collapse" id="icons_group">
    <div class="col-md-12">
        <div class="well">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="icons_search">Название иконки</label>
                        <input type="email" class="form-control" id="icons_search" placeholder="Введите название">
                    </div>
                </div>
            </div>    
            @foreach( $icons as $item)
                <button class="btn icon-button js-icon-btn"
                        style="margin: 5px; padding: 5px; width: 80px; line-height: 1; overflow: hidden"
                        title="{!! $item->name !!}"data-id="{!! $item->id !!}"
                        data-image="/{!! $item->image !!}"
                        onclick="return false">
                    <img src="/{!! $item->image !!}" alt=""
                         style="width: 60px; 
                             height: 60px; 
                             margin: 0 auto 3px;                                                           
                             display: block;">
                    <b><small style="color: #c81919">{!! $item->name !!}</small></b>
                </button>
            @endforeach
        </div>
    </div>
</div>



