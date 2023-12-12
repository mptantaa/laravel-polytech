@extends('layout')
@section('content')

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID статьи</th>
            <th scope="col">Дата</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Текст</th>
            <th scope="col">Автор</th>
        </tr>
    </thead>
    <tbody>
        @foreach($comments as $comment)
        <tr>
            <th scope="row"><a href="/article/{{$comment->article_id}}">{{$comment->article_id}}</a></th>
            <td>{{$comment->created_at}}</td>
            <td>{{$comment->title}}</td>
            <td>{{$comment->text}}</td>
            <td>{{$comment->getUserId()->name}}</td>
            <td>
                @if ($comment->status == 0)
                <a href="/comment/{{$comment->id}}/accept" class="btn btn-secondary">Принять</a>
                @else
                <a href="/comment/{{$comment->id}}/reject" class="btn btn-danger">Отклонить</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$comments->links()}}
@endsection