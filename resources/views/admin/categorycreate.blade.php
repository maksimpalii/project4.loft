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
                    @if($errors)
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="container">
                        <h2>Редактирования Категории</h2>
                        <div class="table-responsive">
                            <form action="/admin/category/create" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="text" name="name" value=""><br>
                                <input type="text" name="description" value=""><br>
                                <input type="submit" value="Сохранить">
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
