@extends('layout')
@section('content')
<form action="/article" method="post">
  @csrf
  <div class="form-group">
    <label for="exampleInputDate1">Дата публикации</label>
    <input name="datePublic" type="date" class="form-control" id="exampleInputDate1">
  </div>
  <div class="form-group">
    <label for="exampleInputTitle1">Заголовок</label>
    <input name="title" type="text" class="form-control" id="exampleInputTitle1">
  </div>
  <div class="form-group">
    <label for="exampleInputshortDesc1">Короткое описание</label>
    <input name="shortDesc" type="text" class="form-control" id="exampleInputshortDesc1" >
  </div>
  <div class="form-group">
    <label for="exampleInputDesc1">Текст</label>
    <textarea name="desc" class="form-control" id="exampleInputDesc1"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection