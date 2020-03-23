<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Astra London - Portfolio">
    <title>Astra London</title>
    <link rel="icon" href="/img/pref/profilePic.jpeg">


    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto&display=swap" rel="stylesheet">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" media="all" rel="stylesheet" defer="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>

  </head>
    @php
        $bk = \App\Pref::first()->background_image_location;
    @endphp
    <body style="background-image: url({{ $bk }})">
    <noscript>You need to enable JavaScript to run this app.</noscript>

    @auth
        <a class="toBackend" href="/backend">Go To Backend</a>
    @endauth
    <div id="app"></div>
    
    <script src="/js/app.js"></script>


  </body>
</html>

