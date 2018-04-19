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
                    </div>
                    <div class="container">
                        <h2>Товары</h2>
                        <div class="table-responsive">
                            <a href="/admin/book/create">Создать</a>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Картинка</th>
                                    <th>Заголовок</th>
                                    <th>Цена</th>
                                    <th colspan="2">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <th>{{$book->id}}</th>
                                    <th><img style="width:100px;" src="/uploads/{{$book->photo}}" alt="Preview-image"></th>
                                    <th>{{$book->name}}</th>
                                    <th>{{$book->price}} руб</th>
                                    <th><a href="/admin/book/edit/{{$book->id}}">Edit</a></th>
                                    <th><a href="/admin/book/destroy/{{$book->id}}">Delete</a></th>
                                </tr>
                            @endforeach
                                </tbody>
                        </table>
                    </div>
                    </div>

                    <div class="content-footer__container">
                        {{$books->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
