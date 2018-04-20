<!DOCTYPE html>
<html lang="ru">
<head>
    <title>ГеймсМаркет - @yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/libs.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/modify.css">
    <link rel="stylesheet" href="/css/media.css">
</head>
<body>
<div class="main-wrapper">
    <header class="main-header">
        <div class="logotype-container"><a href="/" class="logotype-link"><img src="/img/logo.png" alt="Логотип"></a>
        </div>
        <nav class="main-navigation">
            <ul class="nav-list">
                <li class="nav-list__item"><a href="/" class="nav-list__item__link">Главная</a></li>
                <li class="nav-list__item"><a href="{{route('order')}}" class="nav-list__item__link">Мои заказы</a></li>
                <li class="nav-list__item"><a href="#" class="nav-list__item__link">Новости</a></li>
                <li class="nav-list__item"><a href="{{route('about')}}" class="nav-list__item__link">О компании</a></li>
            </ul>
        </nav>
        <div class="header-contact">
            <div class="header-contact__phone"><a href="#" class="header-contact__phone-link">Телефон: 33-333-33</a>
            </div>
        </div>
        <div class="header-container">
            <div class="payment-container">
                <div class="payment-basket__status">
                    <div class="payment-basket__status__icon-block"><a class="payment-basket__status__icon-block__link"><i
                                    class="fa fa-shopping-basket"></i></a></div>
                    <div class="payment-basket__status__basket"><span
                                class="payment-basket__status__basket-value">0</span><span
                                class="payment-basket__status__basket-value-descr">товаров</span></div>
                </div>
            </div>
            <div class="authorization-block">
                @if (Auth::user())
                    <div id="authpanel">
                    <div class="username">{{ Auth::user()->name}}</div>
                        @if(Auth::user()->hasRole('Admin'))
                            <a href="{{ route('admin') }}" class="authorization-block__link admlink">Админка</a>
                        @endif
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                           Выйти
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>

                    </div>
                    @else
                    <a href="{{ route('register') }}" class="authorization-block__link">Регистрация</a>
                    <a href="{{ route('login') }}" class="authorization-block__link">Войти</a>
                @endif
            </div>
        </div>
    </header>
    <div class="middle">
        <div class="sidebar">
            <div class="sidebar-item">
                <div class="sidebar-item__title">Категории</div>
                <div class="sidebar-item__content">
                </div>
            </div>
            <div class="sidebar-item">
                <div class="sidebar-item__title">Последние новости</div>
                <div class="sidebar-item__content">
                    <div class="sidebar-news">
                        <div class="sidebar-news__item">
                            <div class="sidebar-news__item__preview-news">
                                <img src="/img/cover/game-2.jpg" alt="image-new" class="sidebar-new__item__preview-new__image">
                            </div>
                            <div class="sidebar-news__item__title-news">
                                <a href="#" class="sidebar-news__item__title-news__link">
                                    О новых играх в режиме VR</a>
                            </div>
                        </div>
                        <div class="sidebar-news__item">
                            <div class="sidebar-news__item__preview-news">
                                <img src="/img/cover/game-1.jpg" alt="image-new" class="sidebar-new__item__preview-new__image">
                            </div>
                            <div class="sidebar-news__item__title-news">
                                <a href="#" class="sidebar-news__item__title-news__link">
                                    О новых играх в режиме VR</a>
                            </div>
                        </div>
                        <div class="sidebar-news__item">
                            <div class="sidebar-news__item__preview-news">
                                <img src="/img/cover/game-4.jpg" alt="image-new"
                                     class="sidebar-new__item__preview-new__image">
                            </div>
                            <div class="sidebar-news__item__title-news">
                                <a href="#" class="sidebar-news__item__title-news__link">О
                                    новых играх в режиме VR</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="main-content">
                <div class="content-top">
                    <div class="content-top__text">Купить игры неборого без регистрации смс с торента, получить компкт диск, скачать Steam игры после оплаты</div>
                    <div class="slider"><img src="/img/slider.png" alt="Image" class="image-main"></div>
                </div>
                <div class="content-middle">
                    <div class="content-head__container">
                        <div class="content-head__title-wrap">
                            <div class="content-head__title-wrap__title bcg-title">@yield('bcg-title')</div>
                        </div>
                        <div class="content-head__search-block">
                            <div class="search-container">
                                <form class="search-container__form" action="/search" method="GET">
                                    <input type="text" name="s" class="search-container__form__input"  placeholder="Search..">
                                    <input type="submit" class="search-container__form__btn" value="search">
                                </form>
                            </div>
                        </div>
                    </div>
            @yield('content')
        </div>
    </div>
    <footer class="footer">
        <div class="footer__footer-content">
            <div class="random-product-container">
                <div class="random-product-container__head">Случайный товар</div>
                <div class="random-product-container__content">
                </div>
            </div>
            <div class="footer__footer-content__main-content">
                <p>
                    Интернет-магазин компьютерных игр ГЕЙМСМАРКЕТ - это
                    онлайн-магазин игр для геймеров, существующий на рынке уже 5 лет.
                    У нас широкий спектр лицензионных игр на компьютер, ключей для игр - для активации
                    и авторизации, а также карты оплаты (game-card, time-card, игровые валюты и т.д.),
                    коды продления и многое друго. Также здесь всегда можно узнать последние новости
                    из области онлайн-игр для PC. На сайте предоставлены самые востребованные и
                    актуальные товары MMORPG, приобретение которых здесь максимально удобно и,
                    что немаловажно, выгодно!
                </p>
            </div>
        </div>
        <div class="footer__social-block">
            <ul class="social-block__list bcg-social">
                <li class="social-block__list__item"><a href="#" class="social-block__list__item__link"><i
                                class="fa fa-facebook"></i></a></li>
                <li class="social-block__list__item"><a href="#" class="social-block__list__item__link"><i
                                class="fa fa-twitter"></i></a></li>
                <li class="social-block__list__item"><a href="#" class="social-block__list__item__link"><i
                                class="fa fa-instagram"></i></a></li>
            </ul>
        </div>
    </footer>
</div>
        <script
                src="https://code.jquery.com/jquery-2.2.4.min.js"
                integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
                crossorigin="anonymous"></script>
<script src="/js/main.js"></script>
</body>
</html>