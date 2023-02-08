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
                            <h2>Регистрация</h2>
                            <div class="mt-10">            
                                <input type="text" name="surname" placeholder="Фамилия"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Фамилия'" required
                                    class="single-input">
                            </div>
                            <div class="mt-10">            
                                <input type="text" name="name" placeholder="Имя"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Имя'" required
                                    class="single-input">
                            </div>
                            <div class="mt-10">            
                                <input type="text" name="patronymic" placeholder="Отчество"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Отчество'"
                                    class="single-input">
                            </div>
                            <div class="mt-10">            
                                <input type="text" name="phone" placeholder="Телефон"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Телефон'" required
                                    class="single-input">
                            </div>
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
                            
                            <div class="mt-10">
                                <input type="password" name="password_confirmation" placeholder="Повторите пароль"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Повторите пароль'" required
                                    class="single-input">
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="genric-btn success-border circle">Зарегистрироваться</button>
                            </div>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
        
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
@endsection