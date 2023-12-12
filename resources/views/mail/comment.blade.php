<div class="container">
    <h2>В статье №{{$comment->article_id}} добавлен новый комментарий: {{$comment->title}}</h2>
    <p>Текст комментария: {{$comment->text}}</p>
    <p><a href="http://127.0.0.1:8000/comment/{{$comment->id}}/accept">Принять комментарий</a></p>
</div>