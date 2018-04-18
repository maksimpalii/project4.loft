@extends('layout')
@section('title', 'Мои заказы')
@section('bcg-title', 'Мои заказы')
@section('content')
            <div class="content-main__container">
                <div class="cart-product-list">

                    @if (Auth::user())
                    @foreach($orders as $order)
                    <div class="cart-product-list__item">
                        <div class="cart-product__item__product-photo"><img src="/uploads/{{$order->books->photo}}" class="cart-product__item__product-photo__image"></div>
                        <div class="cart-product__item__product-name">
                            <div class="cart-product__item__product-name__content"><a href="/product/{{$order->books->id}}">{{$order->books->name}}</a></div>
                        </div>
                        <div class="cart-product__item__cart-date">
                            <div class="cart-product__item__cart-date__content">{{date('d.m.Y', strtotime($order->created_at))}}</div>
                        </div>
                        <div class="cart-product__item__product-price"><span class="product-price__value">{{$order->books->price}} рублей</span></div>
                    </div>
                    @endforeach
                        @else
                         <h2>Авторизуйтесь или зарегистрируйтесь под своим email,<br> для просмотра своих заказов</h2>
                    @endif
                </div>
            </div>
            <div class="content-footer__container">
                @if (Auth::user())
                {{$orders->links()}}
                    @endif
            </div>
        </div>
        <div class="content-bottom"></div>
    </div>
@endsection

