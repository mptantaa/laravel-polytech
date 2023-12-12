@extends('layout')
@section('content')
<div class="alert-danger">
  @if ($errors->any())
    @foreach($errors->all() as $error)
    <ul>
      <li>{{$error}}</li>
    </ul>
    @endforeach
  @endif
</div>
<form action="/comment/{{$comment->id}}" method="post">
  @csrf
  @method('PUT')
  <input type="hidden" name="article_id" value="{{$comment->article_id}}">
  <div class="form-group">
    <label for="exampleInputTitle1">Заголовок</label>
    <input name="title" type="text" class="form-control" id="exampleInputTitle1" value="{{$comment->title}}">
  </div>
  <div class="form-group">
    <label for="exampleInputText1">Текст</label>
    <textarea name="text" class="form-control" id="exampleInputText1">{{$comment->text}}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Обновить комментарий</button>
</form>
@endsection