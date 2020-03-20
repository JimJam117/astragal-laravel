@extends('layouts.base')

@section('title')
{{$post->title}}
@endsection

@section('content')
@include('partials.search')
<div class="container">

    <div class="post">

        
        <img class="post_thumbnail" src="{{$post->image}}" alt="{{$post->title}}">

        <div class="post_container">
            <br>
            <p class="timestamp">{{$post->created_at}}</p>
            @auth
            <div class="endSection">
                <button onclick="location.href='/post/{{$post->slug}}/delete-confirm';" class="social-button">X</button>
                <button onclick="location.href='/post/{{$post->slug}}/edit';" class="social-button"><i
                        class="fas fa-pen"></i></button>
            </div>

            @endauth
            <h1>{{$post->title}}</h1>

            @isset($category)
            <a class="part-of-project" href="/category/{{$post->category->title}}">This post is a part of:
                {{$post->category->title}}</a>
            @endisset
            
            <div class="post-body">
                {!!$post->body!!}
            </div>
            
            <br>
            <hr><br>
            <br>
            <a href="/posts" class="btn readMore">Go Back</a>
            <br><br>
        </div>
        <br>
    </div>



    <div class="sidebar_container">
        <div class="sidebar">
            <h3>Links</h3>
            <ul style="list-style: none;">
                <li><a class="btn sidebar-btn" href="/github"><i class="fab fa-github"></i> Github</a></li>
                <li><a class="btn sidebar-btn" href="/contact"><i class="fas fa-envelope-square"></i> Contact</a></li>
            </ul>
            <hr>

            @isset($category)
            <h3>Part of Project:</h3>
            <a class="sidebar_post" href="/category/{{$category->title}}">
                <img class="sidebar_post_image" src="{{$category->image}}" />
                <div class="sidebar_post_content">
                    <h4>{{$category->title}}</h4>
                    <em>{{strip_tags(Str::limit($category->body, 50))}}</em>
                </div>
            </a>
            <hr>
            <a style="text-decoration: none" href="/categories"><strong>View All Projects</strong></a>
            <br>
            @else
            <br>
            <h3><i class="fas fa-pen"></i> Recent Post</h3>
            <a class="sidebar_post" href="/post/{{$recent_post->slug}}">
                <img class="sidebar_post_image" src="{{$recent_post->image}}" />
                <div class="sidebar_post_content">
                    <h4>{{$recent_post->title}}</h4>
                    <em>{{strip_tags(Str::limit($recent_post->body, 50))}}</em>
                </div>
            </a>
            @endisset


        </div>
    </div>

</div>

@endsection

@section('extra-scripts')
<style>
    .part-of-project {
        text-decoration: none;
        font-weight: 500;
        font-style: italic;
        margin: 1em 0 1.5em 0;
        display: block;
    }

    @media only screen and (max-width: 650px) {
        .main {
            padding: 1em 0;
        }
    }

</style>
@endsection
