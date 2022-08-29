@extends('layouts.main')

@section('content')
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            padding: 0 0 0 20px;
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>

    <div class="container">
           
        @if(0)
            {{--Не понравилось использование самих полей, оставляю для примера--}}
            <h2 class="form-signin-heading">Вход</h2>
            {!! Form::email('email', $value = null, ['class' => "form-control", 'placeholder' => "Email address", 'required' => "", 'autofocus' => ""]) !!}
            {!! Form::password('password', ['class' => "form-control", 'placeholder' => "Password", 'required' => ""]) !!}
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Запомнить меня
            </label>
            {!! Form::button('Войти', ['class' => "btn btn-lg btn-primary btn-block", 'type' => "submit"]) !!}
        @endif

        {!! Form::open( ['class' => 'form-signin', 'role' => 'form']) !!}
            
            <h2 class="form-signin-heading">Вход</h2>
            <input type="email" class="form-control" placeholder="Email address" required="" autofocus="">
            <input type="password" class="form-control" placeholder="Password" required="">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Запомнить меня
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        
        {!! Form::close() !!}

    </div>
    
@endsection
