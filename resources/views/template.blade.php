<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon joli site</title>
    {!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') !!}
    {!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css') !!}
    <!--[if lt IE 9]>
      {!! Html::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') !!}
      {!! Html::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') !!}
    <![endif]-->
  </head>
  <body>
    <header class="jumbotron">
      <div class="container">
        <h1  class="page-header">{!! link_to('/', 'Le site des sondages !') !!}</h1>
        @if(auth()->check())
          <div class="btn-group pull-right">          
            {!! link_to('logout', 'Deconnexion', ['class' => 'btn btn-info']) !!}
          </div>
        @else
          {!! link_to('login', 'Se connecter', ['class' => 'btn btn-info pull-right']) !!}
        @endif
      </div>
    </header>
    <div class="container">
      @yield('contenu')
    </div>
    @yield('scripts')
  </body>
</html>