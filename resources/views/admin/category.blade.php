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
                        <h2>Категории</h2>
                        <div class="table-responsive">
                            <a href="/admin/category/create">Создать</a>
                            <table class="table">
                                <thead>
                            <tr>
                                <th>#</th>
                                <th>Заголовок</th>
                                <th>Описание</th>
                                <th colspan="2">Действия</th>
                            </tr>
                                </thead>
                            <tbody>
                            @foreach($cats as $cat)
                                <tr>
                                    <th>{{$cat->id}}</th>
                                    <th>{{$cat->name}}</th>
                                    <th>{{$cat->description}}</th>
                                    <th><a href="/admin/category/edit/{{$cat->id}}">Edit</a></th>
                                    <th><a href="/admin/category/destroy/{{$cat->id}}">Delete</a></th>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="content-footer__container">
                        {{$cats->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
