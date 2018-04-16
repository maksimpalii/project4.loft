@extends('layout')
@section('title', 'Главная')
@section('content')
    <div class="main-content">
        <div class="content-top">
            <div class="content-top__text">Купить игры неборого без регистрации смс с торента, получить компкт диск, скачать Steam игры после оплаты</div>
            <div class="slider"><img src="img/slider.png" alt="Image" class="image-main"></div>
        </div>
        <div class="content-middle">
            <div class="content-head__container">
                <div class="content-head__title-wrap">
                    <div class="content-head__title-wrap__title bcg-title">Последние товары</div>
                </div>
                <div class="content-head__search-block">
                    <div class="search-container">
                        <form class="search-container__form" action="/search/" method="GET">
                            <input type="text" name="search" class="search-container__form__input">
                            <input type="submit" class="search-container__form__btn" value="search">
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-main__container">
                <div class="products-columns">
                    @foreach($books as $book)
                        <div class="products-columns__item">
                            <div class="products-columns__item__title-product"><a href="/product/{{$book->id}}" class="products-columns__item__title-product__link">{{$book->name}}</a></div>
                            <div class="products-columns__item__thumbnail"><a href="/product/{{$book->id}}" class="products-columns__item__thumbnail__link"><img src="uploads/{{$book->photo}}" alt="Preview-image" class="products-columns__item__thumbnail__img"></a></div>
                            <div class="products-columns__item__description"><span class="products-price">{{$book->price}} руб</span><a href="#" class="btn btn-blue">Купить</a></div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="content-footer__container">
                {{$books->links()}}
            </div>
        </div>
        <div class="content-bottom"></div>
    </div>
@endsection

