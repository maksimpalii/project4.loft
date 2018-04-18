@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                    <div class="content-main__container">
                        <div class="cart-product-list">
                                @foreach($orders as $order)
                                    <div class="cart-product-list__item">
                                        <div class="cart-product__item__product-photo"><img width="50px" src="/uploads/{{$order->books->photo}}" class="cart-product__item__product-photo__image"></div>
                                        <div class="cart-product__item__product-name">
                                            <div class="cart-product__item__product-name__content"><a href="/product/{{$order->books->id}}">{{$order->books->name}}</a></div>
                                        </div>
                                        <div class="cart-product__item__cart-date">
                                            <div class="cart-product__item__cart-date__content">{{date('d.m.Y', strtotime($order->created_at))}}</div>
                                        </div>
                                        <div class="cart-product__item__product-price"><span class="product-price__value">{{$order->books->price}} рублей</span></div>
                                    </div>
                                @endforeach
                        </div>
                    </div>

                    <div class="content-footer__container">
                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
