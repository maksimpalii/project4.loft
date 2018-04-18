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
                        <table class="products-columns">
                            <tr class="products-columns__head">
                                <th>Картинка</th>
                                <th>Заголовок</th>
                                <th>Цена</th>
                                <th colspan="2">Действия</th>
                            </tr>
                            @foreach($books as $book)
                                <tr class="products-columns__item">
                                    <th class="products-columns__item__thumbnail"><img style="width:100px;" src="/uploads/{{$book->photo}}" alt="Preview-image" class="products-columns__item__thumbnail__img"></th>
                                    <th class="products-columns__item__title-product">{{$book->name}}</th>
                                    <th class="products-columns__item__description"><span class="products-price">{{$book->price}} руб</span></th>
                                    <th><a href="/admin/book/edit/{{$book->id}}">Edit</a></th>
                                    <th><a href="/admin/book/destroy/{{$book->id}}">Delete</a></th>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="content-footer__container">
                        {{$books->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
