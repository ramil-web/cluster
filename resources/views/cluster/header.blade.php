
<header class="navbar-fixed-top main-header" role="navigation">
    
    <div class="mb0 navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Cluster.App</a>
            </div>
            <div class="navbar-collapse collapse">

                <div class="navbar-form navbar-left">
                    <ul class="nav nav-pills">
                        <li class="{{ Helpers::set_menu_active(['/']) }}">
                            <a href="{{ url('/') }}">Главная</a>
                        </li>
                        <li class="{{ Helpers::set_menu_active(['wb']) }}">
                            <a href="{{ route('wb.base_index') }}">WB</a>
                        </li>
                        <li class="{{ Helpers::set_menu_active(['analytics']) }}">
                            <a href="{{ route('wb.analytics') }}">Аналитика</a>
                        </li>
                        <li class="{{ Helpers::set_menu_active(['rivals']) }}">
                            <a href="{{ route('wb.rival_index') }}">Rivals</a>
                        </li>
                        <li class="{{ Helpers::set_menu_active(['undersort']) }}">
                            <a href="{{ route('wb.undersort_index') }}">Подсортировка</a>
                        </li>
                        <li class="{{ Helpers::set_menu_active(['pivot_table']) }}">
                            <a href="{{ route('wb.pivot_table') }}">Сводная</a>
                        </li>
                        <li class="{{ Helpers::set_menu_active(['test_index']) }}">
                            <a href="{{ route('wb.test_index') }}">TEST</a>
                        </li>
                    </ul>
                </div>

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
                        {{--<button class="btn btn-success"--}}
                                {{--data-toggle="modal"--}}
                                {{--data-target="#loginModal">--}}
                            {{--Войти--}}
                        {{--</button>--}}
                    @endif

                </div>

            </div><!--/.navbar-collapse -->
        </div>    
    </div>
    
</header>

{{--@include('components.modals.register')--}}
{{--@include('components.modals.login')--}}