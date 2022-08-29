@extends('layouts.admin.main')

@section('content')
    <style>
        body {
            padding-top      : 40px;
            padding-bottom   : 40px;
            background-color : #eee;
        }

        .form-signin {
            max-width : 330px;
            padding   : 15px;
            margin    : 0 auto;
        }

        .form-signin .form-group{
            margin-bottom : 10px;
        }

        .form-signin .checkbox {
            font-weight : normal;
        }

        .form-signin .form-control {
            position           : relative;
            height             : auto;
            -webkit-box-sizing : border-box;
            -moz-box-sizing    : border-box;
            box-sizing         : border-box;
            padding            : 10px;
            font-size          : 16px;
        }

        .form-signin .form-control:focus {
            z-index : 2;
        }

        .form-signin input[type="email"] {
            margin-bottom              : -1px;
            border-bottom-right-radius : 0;
            border-bottom-left-radius  : 0;
        }

        .form-signin input[type="password"] {
            border-top-left-radius  : 0;
            border-top-right-radius : 0;
        }
    </style>

    <div class="container">

        {!! Form::open( ['route' => 'admin.login.submit', 'method' => 'POST','class' => 'form-signin', 'role' => 'form']) !!}

        <div class="form-group clearfix{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-12 control-label">E-Mail</label>

            <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
                       autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group clearfix{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-12 control-label">Пароль</label>

            <div class="col-md-12">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group clearfix hidden">
            <div class="col-md-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group clearfix">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block">
                    Войти
                </button>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection
