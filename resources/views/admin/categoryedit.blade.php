@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Редактирования Категории</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    @if($errors)
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="container">
                        <div class="form-style-5">
                            <form  action="/admin/category/update/{{$cat->id}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <fieldset>
                                    <label for="name">Название:</label>
                                    <input type="text" id="name" name="name" value="{{$cat->name}}">
                                    <label for="description">Описание:</label>
                                    <textarea id="description" name="description">{{$cat->description}}</textarea>
                                </fieldset>
                                <input type="submit" value="Сохранить" />
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
