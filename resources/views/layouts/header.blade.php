<style>
    body {
        padding-top    : 50px;
        padding-bottom : 20px;
    }
</style>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Название сайта</a>
        </div>
        <div class="navbar-collapse collapse">

            <div class="navbar-form navbar-right">
                @if (Auth::check())
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <button class="btn btn-success">
                            Выйти
                        </button>
                    </a>
                    {!! Form::open( ['route' => 'logout', 'method' => 'POST','class' => 'hidden', 'id' => 'logout-form', 'role' => 'form']) !!}
                    {!! Form::close() !!}

                @else
                    <button class="btn btn-success"
                            data-toggle="modal"
                            data-target="#registerModal">
                        Регистрация
                    </button>
                    <button class="btn btn-success"
                            data-toggle="modal"
                            data-target="#loginModal">
                        Войти
                    </button>
                @endif
                
            </div>

        </div><!--/.navbar-collapse -->
    </div>
</div>

@include('components.modals.register')
@include('components.modals.login')