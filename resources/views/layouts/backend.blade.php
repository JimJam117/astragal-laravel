<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        .topbar {
            background-color: darkred;
            color: white;
            display: flex;
            flex-direction: row;
            padding: 5px;
            width: 100%;
        }
        .topbar div a{
            color:white;
        }
        .topbar div a:visited{
            color:white;
        }

    </style>
</head>

<body>
    <div class="topbar">
        <div>
            <a href="/home">frontend</a>
            <a href="/post/create">create post</a>
            <a href="/category/create">create category</a>
        </div>
        <div>
            {{Auth::user()->username}}
        </div>

    </div>
    @yield('content')
</body>

</html>
