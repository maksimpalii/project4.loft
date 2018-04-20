@extends('layout')
@section('title', $cat_this->name)
@section('bcg-title', 'Игры в разделе ' . $cat_this->name)
@section('content')
                <div class="content-main__container">
                    <div class="products-columns">
                        @foreach($books as $book)
                        <div class="products-columns__item">
                            <div class="products-columns__item__title-product"><a href="/product/{{$book->id}}" class="products-columns__item__title-product__link">{{$book->name}}</a></div>
                            <div class="products-columns__item__thumbnail"><a href="/product/{{$book->id}}" class="products-columns__item__thumbnail__link"><img src="/uploads/{{$book->photo}}" alt="Preview-image" class="products-columns__item__thumbnail__img"></a></div>
                            <div class="products-columns__item__description"><span class="products-price">{{$book->price}} руб</span><a href="/product/{{$book->id}}" class="btn btn-blue">Купить</a></div>
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