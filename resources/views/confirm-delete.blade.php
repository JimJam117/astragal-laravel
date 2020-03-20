@extends('layouts.base')

@section('title')
    Confirm Delete
@endsection

@section('content')

@isset($post)
<form action="/post/{{$post->slug}}" method="POST">
    @csrf
    @method('DELETE')

    <h1>Confrim deleting {{$post->title}}</h1>
    <p>Are you sure you want to delete this post?</p>
    <button type="submit">Confirm</button>
</form>
@endisset

@isset($category)
<form action="/category/{{$category->title}}" method="POST">
    @csrf
    @method('DELETE')

    <h1>Confrim deleting {{$category->title}}</h1>
    <p>Are you sure you want to delete this category?</p>
    <button type="submit">Confirm</button>
</form>
@endisset

    
@endsection