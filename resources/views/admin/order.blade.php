@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Заказы</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Картинка</th>
                                    <th>Название</th>
                                    <th>Цена</th>
                                    <th>Дата</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <th>{{$order->id}}</th>
                                        <th><img width="70px" src="/uploads/{{$order->books->photo}}"></th>
                                        <th><a href="/product/{{$order->books->id}}">{{$order->books->name}}</a></th>
                                        <th>{{$order->books->price}} рублей</th>
                                        <th>{{date('d.m.Y', strtotime($order->created_at))}}</th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
