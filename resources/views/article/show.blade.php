@extends('layout')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Дата</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Короткое описание</th>
            <th scope="col">Содержание</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr>
            <th scope="row">{{$article['datePublic']}}</th>
            <td>{{$article['title']}}</td>
            <td>{{$article['shortDesc']}}</td>
            <td>{{$article['desc']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection