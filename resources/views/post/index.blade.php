@extends('layouts.blog')

@section('title')
    Blog
@endsection



@section('posts_content')
@foreach($posts as $post)
<a href="\post\{{$post->slug}}" class="unlinkStyle">
    <div class="section post_link">
        <img class="post_thumbnail" src="{{$post->image}}" alt="{{$post->title}}">
        
        <div class="post_container">
            <br>
            <p class="timestamp">{{$post->created_at}}</p>

            <h1>{{$post->title}}</h1>

            <em>{{strip_tags(Str::limit($post->body, 200))}}</em>
            <br>
            <br>
        </div>

    </div>
</a>
@endforeach

{{$posts->links()}}
@endsection
