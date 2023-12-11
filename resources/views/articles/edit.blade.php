@extends('layout')
@section('content')
<form action="/article/{{$article->id}}" method="post">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="exampleInputDate1">Дата публикации</label>
    <input name="datePublic" type="date" class="form-control" id="exampleInputDate1" value="{{$article->datePublic}}">
  </div>
  <div class="form-group">
    <label for="exampleInputTitle1">Заголовок</label>
    <input name="title" type="text" class="form-control" id="exampleInputTitle1" value="{{$article->title}}">
  </div>
  <div class="form-group">
    <label for="exampleInputshortDesc1">Короткое описание</label>
    <input name="shortDesc" type="text" class="form-control" id="exampleInputshortDesc1" value="{{$article->shortDesc}}">
  </div>
  <div class="form-group">
    <label for="exampleInputDesc1">Текст</label>
    <textarea name="desc" class="form-control" id="exampleInputDesc1">{{$article->desc}}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection