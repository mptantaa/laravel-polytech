@extends('layout')
@section('content')
<div class="card" style="width: 100%;">
  <div class="card-body">
    <h5 class="card-title">{{$article->title}}</h5>
    <h6 class="card-subtitle mb-2 text-muted">{{$article->shortDesc}}</h6>
    <p class="card-text">{{$article->desc}}</p>
    <div class="btn-group" role="group">
        <a href="/article/{{$article->id}}/edit" class="btn btn-link">Редактировать</a>
        <form action="/article/{{$article->id}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-link" type="submit">Удалить</button>
        </form> 
    </div>
  </div>
</div>
<h3 class="mt-3">Комментарии</h3>
<div class="alert-danger">
  @if ($errors->any())
    @foreach($errors->all() as $error)
    <ul>
      <li>{{$error}}</li>
    </ul>
    @endforeach
  @endif
</div>
<form action="/comment" method="post">
  @csrf
  <div class="form-group">
      <label for="exampleInputTitle"1>Заголовок</label>
      <input name="title" type="text" class="form-control" id="exampleInputTitle1">
  </div>
  <div class="form-group">
    <label for="exampleInputText1">Текст</label>
    <input name="text" type="text" class="form-control" id="exampleInputText1">
  </div>
  <div class="form-group">
    <input type="hidden" name="article_id" value="{{$article->id}}">
  </div>
<button type="submit" class="btn btn-primary">Добавить комментарий</button>
</form>
@foreach($comments as $comment)
<div class="card" style="width: 50%;">
  <div class="card-body">
    <h5 class="card-title">{{$comment->title}}</h5>
    <p class="card-text">{{$comment->text}}</p>
    <div class="btn-group" role="group">
      <a href="/comment/{{$comment->id}}/edit" class="btn btn-link">Редактировать</a>
      <form action="/comment/{{$comment->id}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-link" type="submit">Удалить</button>
        </form> 
    </div>
  </div>
</div>
@endforeach
@endsection