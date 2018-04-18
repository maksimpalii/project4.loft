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
                        @if($errors)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form action="/admin/book/update/{{$book->id}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="text" name="name" value="{{$book->name}}"><br>
                            <input type="text" name="description" value="{{$book->description}}"><br>
                            <input type="text" name="category_id" value="{{$book->category_id}}"><br>
                            <input type="text" name="price" value="{{$book->price}}"><br>
                            <input type="file" name="image"><br>
                            <input type="submit" value="Сохранить">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
