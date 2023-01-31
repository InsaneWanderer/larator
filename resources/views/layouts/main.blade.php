<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Real state</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ HTML::style('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('css/animate.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('css/slick.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ HTML::style('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ HTML::style('css/style.css') }}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="index.html">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    @if (Auth::user())
                                        <div class="book_btn d-none d-lg-block">
                                            <a href="{{ route('adverts.create') }}">Создать объявление</a>
                                        </div>
                                        <div class="book_btn d-none d-lg-block">
                                            <a href="{{ route('logout') }}">Выйти</a>
                                        </div>
                                    @else
                                        <div class="book_btn d-none d-lg-block">
                                            <a href="{{ route('login') }}">Войти</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </header>

    @section('content')
</body>