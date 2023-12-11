@extends('layout')
@section('content')
    <h3>Контакты</h3>
    <p>{{$contact['name']}}</p>
    <p>Адрес: {{$contact['address']}}</p>
    <p>Телефон: {{$contact['phone']}}</p>
    <p>Почта: {{$contact['email']}}</p>
@endsection