<!doctype html>
<html lang="en">
  <head>
    <title>Новости</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <style>
      .hidden {
          display: none;
      }
    </style>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item @activeLink('article')" >
            <a class="nav-link" href="/article">Статьи</a>
          </li>
          @can('create')
          <li class="nav-item @activeLink('article/create')">
            <a class="nav-link" href="/article/create">Создать статью</a>
          </li>
          <li class="nav-item @activeLink('comment')">
            <a class="nav-link" href="/comment">Список комментариев</a>
          </li>
          @endcan
          <li class="nav-item @activeLink('about')">
            <a class="nav-link" href="/about">О нас <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item @activeLink('contact')">
            <a class="nav-link" href="/contact">Контакты</a>
          </li>
        </ul>
      </div>
      
      <div class="navbar-nav d-flex justify-content-end">
        @guest
        <li class="nav-item @activeLink('signup')">
          <a class="nav-link" href="/signup">Регистрация</a>
        </li>
        <li class="nav-item @activeLink('signin')">
          <a class="nav-link" href="/signin">Вход</a>
        </li>
        @endguest
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              Уведомлений: {{auth()->user()->unreadNotifications->count()}}
            </a>
            <div class="dropdown-menu">
              @foreach(auth()->user()->unreadNotifications as $notification)
                <a class="dropdown-item" href="/article/{{$notification->data['article']['id']}}?notify={{$notification->id}}">Новая статья: {{$notification->data['article']['title']}}</a>
              @endforeach
            </div>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout">Выход</a>
        </li>      
        @endauth
      </div>
      </nav>
    </header>
    <main>
      <div id="app">
        <App />
      </div>
      <div class="container">
        @yield('content')
      </div>
    </main>  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}"></script> 
  </body>

</html>