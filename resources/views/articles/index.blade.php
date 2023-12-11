@extends('layout')
@section('content')

<table class="table">
    <thead>
        <tr>
            <th scope="col">Дата</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Короткое описание</th>
            <th scope="col">Текст</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr>
            <th scope="row">{{$article->datePublic}}</th>
            <td><a href="/article/{{$article->id}}">{{$article->title}}</a></td>
            <td>{{$article->shortDesc}}</td>
            <td>{{$article->desc}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$articles->links()}}
@endsection