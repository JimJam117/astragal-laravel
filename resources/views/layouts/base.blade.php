<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="James Sparrow - Web Developer">
    <title>Jsparrow | @yield('title')</title>
    <link rel="icon" href="/img/jimjam.ico">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Public+Sans:300S&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        
        

    </style>
</head>

<body
    style="background-image: linear-gradient(rgba(19, 19, 24, 0.81), rgba(37, 44, 71, 0.83)), url('/img/background.jpeg');">


    <div class="topbar">
        <!-- <div> <img class="ProfilePic" src="/img/jimjam3.png" alt="James"></div> -->
        <div class="topbar-section">
        <div class="title">
            <h1>James Sparrow</h1>
            <h3>Web Developer</h3>
        </div>

        <nav class="navbar">
            <a href="/home">Home</a>
            <a href="/posts">Blog</a>
            <a href="/portfolio">Portfolio</a>
            <!--<a href="#">CV</a>-->
        </nav>    
    </div>
    </div>

    @auth
    <div class="control-nav">
        <a href="/post/create">Create Post</a>
        <a href="/category/create">Create Category</a>
        <button class="login" onclick="document.getElementById('logout-form').submit();">{{Auth::user()->name}}:
            logout</button>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    @endauth

    <div class="main">
        <!-- <div id="example"></div> example component -->
        @yield('content')
        <br>
        <hr>
        <div class="endSection"> 
           
            <button aria-label="Github" onclick="location.href='/github';" type="button" class="social-button social-button-github">
                <i class="fab fa-github"></i>
            </button>
            <button aria-label="Contact" onclick="location.href='/contact';" type="button" class="social-button" name="button">
                <i class="fas fa-envelope"></i>
            </button>
        </div>
        <br>
        <br>
        <footer>jamessparrow101@googlemail.com</footer>
    </div>
</body>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" media="all" rel="stylesheet" defer="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    @yield('extra-scripts')

</html>
