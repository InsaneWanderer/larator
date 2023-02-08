@extends('layouts.main')

@section('content')

<div class="  d-flex align-items-center ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 offset-xl-3" style="margin-top: 200px; border-style:solid; border-width: 1px; padding:20px">
                <div class="property_wrap">
                    <div class="slider_text text-center justify-content-center">
        
                        <form method="POST" action="">
                            @csrf
                            <h2>Авторизация</h2>
                            
                            <div class="mt-10">            
                                <input type="email" name="email" placeholder="Email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required
                                    class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="password" name="password" placeholder="Пароль"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Пароль'" required
                                    class="single-input">
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="genric-btn success-border circle">Войти</button>
                            </div>
                            
                            @if (sizeof($errors) > 0)
                                <div class="mt-5">
                                    <h5 style="color: red;">{{ $errors[0] }}</h5>
                                </div>                                
                            @endif
                            <div style="margin-top: 50px">
                                <a href="{{ route('registrate') }}">Нет аккаунта? Зарегистрироваться</a>
                            </div>
                        </form>
        
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
@endsection