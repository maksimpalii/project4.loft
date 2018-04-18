@extends('layout')
@section('title', $book->name . ' в разделе ' . $cat->name)
@section('bcg-title',  $book->name . ' в разделе ' . $cat->name)
@section('content')
            <div class="content-main__container">
                <div class="product-container">
                    <div class="product-container__image-wrap"><img src="/uploads/{{$book->photo}}"
                                                                    class="image-wrap__image-product"></div>
                    <div class="product-container__content-text">


                        <div class="product-container__content-text__title">{{$book->name}}</div>
                        <div class="product-container__content-text__price">
                            <div class="product-container__content-text__price__value">
                                Цена: <b>{{$book->price}}</b>
                                руб
                            </div>
                            <a href="#" class="btn btn-blue">Купить</a>
                        </div>
                        <div class="product-container__content-text__description">
                            <p>
                                {{$book->description}}
                            </p>
                        </div>
                        <div>
                        <form id="form-buy" action="/order/store" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <input type="text" name="name"><br>
                            @if (Auth::user())
                                <input type="text" name="email" value="{{ Auth::user()->email}}"><br>
                            @else
                                <input type="text" name="email"><br>
                            @endif
                            <input id="buy_product" type="submit">
                        </form>
                            <div id="outmessage"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-bottom">
            <div class="line"></div>
            <div class="content-head__container">
                <div class="content-head__title-wrap">
                    <div class="content-head__title-wrap__title bcg-title">Посмотрите наши товары</div>
                </div>
            </div>
            <div class="content-main__container">
                <div class="products-columns">
                    @foreach($booksView as $bookView)
                        <div class="products-columns__item">
                            <div class="products-columns__item__title-product">
                                <a href="/product/{{$bookView->id}}" class="products-columns__item__title-product__link">{{$bookView->name}}</a>
                            </div>
                            <div class="products-columns__item__thumbnail">
                                <a href="/product/{{$bookView->id}}" class="products-columns__item__thumbnail__link">
                                    <img src="/uploads/{{$bookView->photo}}" alt="Preview-image"
                                            class="products-columns__item__thumbnail__img">
                                </a>
                            </div>
                            <div class="products-columns__item__description">
                                <span class="products-price">{{$bookView->price}} руб</span>
                                <a href="#" class="btn btn-blue">Купить</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

