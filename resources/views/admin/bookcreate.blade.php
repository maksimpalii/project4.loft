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

                        <form action="/admin/book/create" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="text" name="name" value=""><br>
                            <input type="text" name="description" value=""><br>
                            <div class="form-group">
                                {{--{{ Form::select('category_id', array('L' => 'Large', 'S' => 'Small'), $book->category_id)}}--}}
                                {{ Form::select('category_id', $categories)}}
                            </div>
                            <input type="text" name="price" value=""><br>
                            <input type="file" name="image"><br>
                            <input type="submit" value="Добавить">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
