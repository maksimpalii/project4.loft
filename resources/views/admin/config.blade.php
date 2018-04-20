@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Настройки</div>

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
                            <form  action="/admin/config" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <fieldset>
                                    <label for="email">Email для уведомлений:</label>
                                    @if(!empty($opt->value))
                                    <input type="email" id="email" name="email" value=" {{$opt->value}}">
                                    @else
                                        <input type="email" id="email" name="email">
                                    @endif
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
