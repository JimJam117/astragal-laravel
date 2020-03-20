@extends('layouts.blog')

@section('title')
    Projects
@endsection

@section('banner')
<div class="banner" style="margin-bottom: 2em;">
    <h1>Projects</h1>
    <p>
        Here are some of the categories that the blog posts are about. These can be either projects I am working on
        and have made multiple posts about or just topics in general which some undirectly related posts are grouped
        together.
    </p>
</div>
@endsection

@section('posts_content')
@foreach($categories as $category)
<a href="\category\{{$category->title}}" class="unlinkStyle">
    <div class="section post_link">
        <img class="post_thumbnail" src="{{$category->image}}" alt="{{$category->title}}">
        
        <div class="post_container">
            <br>
            <div class="timestamp">{{$category->created_at}}</div>

            <h1>{{$category->title}}</h1>

            <em>{{strip_tags(Str::limit($category->body, 200))}}</em>
            <br>
            <br>
        </div>

    </div>
</a>
@endforeach

{{$categories->links()}}
@endsection

@section('extra-scripts')
    <style>
        .posts_container {
            width: 100%;
        }
    </style>
@endsection
