@extends('layout')
@section('content')
<div class="card" style="width: 18rem;">
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
</table>
@endsection