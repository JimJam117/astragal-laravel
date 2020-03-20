@extends('layouts.base')

@section('title')
{{$search}}
@endsection

@section('content')
@include('partials.search')
<div class="container">
    <div class="posts_container">

        <h1>Search Results for "{{$search}}"</h1>
        <br>
        @if(!$results_posts->isEmpty())
        <h1>Posts</h1>
        <hr>
        <br>
        @foreach ($results_posts as $item)
        <a href="\post\{{$item->slug}}" class="unlinkStyle">
            <div class="section post_link">
                <div class="post_thumbnail" style="background-image: url('{{$item->image}}');" alt="{{$item->title}}">
                </div>
                <div class="post_container">
                    <br>
                    <p class="timestamp">{{$item->created_at}}</p>

                    <h1>{{$item->title}}</h1>

                    <em>{{strip_tags(Str::limit($item->body, 100))}}</em>
                    <br>
                    <br>
                </div>

            </div>
        </a>
        @endforeach
        @endif

        <br>
        @if(!$results_categories->isEmpty())
        <h1>Categories</h1>
        <hr>
        <br>
        @foreach ($results_categories as $item)
        <a href="\category\{{$item->title}}" class="unlinkStyle">
            <div class="section post_link">
                <div class="post_thumbnail" style="background-image: url('{{$item->image}}');" alt="{{$item->title}}">
                </div>
                <div class="post_container">
                    <br>
                    <p class="timestamp">{{$item->created_at}}</p>

                    <h1>{{$item->title}}</h1>

                    <em>{{strip_tags(Str::limit($item->body, 100))}}</em>
                    <br>
                    <br>
                </div>

            </div>
        </a>

        @endforeach
        @endif

        @if($results_posts->isEmpty() && $results_categories->isEmpty())
        <p>No results found ;(</p>
        @endif

    </div>
</div>



@endsection

@section('extra-scripts')
<style>
    @media only screen and (max-width: 650px) {
        .posts_container {
            width: 100%;
        }
    }

</style>
@endsection
