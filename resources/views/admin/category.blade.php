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
                                <th>Заголовок</th>
                                <th>Описание</th>
                                <th colspan="2">Действия</th>
                            </tr>
                            @foreach($cats as $cat)
                                <tr class="products-columns__item">
                                    <th class="products-columns__item__title-product">{{$cat->name}}</th>
                                    <th class="products-columns__item__description"><span class="products-price">{{$cat->description}}</span></th>
                                    <th><a href="/admin/category/edit/{{$cat->id}}">Edit</a></th>
                                    <th><a href="/admin/category/destroy/{{$cat->id}}">Delete</a></th>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="content-footer__container">
                        {{$cats->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
