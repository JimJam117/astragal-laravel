@extends('layouts.backend')

@section('title')
    Confirm Delete
@endsection

@section('content')

@isset($post)
<form action="/backend/post/{{$post->id}}" method="POST">
    @csrf
    @method('DELETE')

    <h1>Confrim deleting {{$post->title}}</h1>
    <p>Are you sure you want to delete this post?</p>
    <button type="submit">Confirm</button>
</form>
@endisset

@isset($category)
<form action="/backend/album/{{$category->id}}" method="POST">
    @csrf
    @method('DELETE')

    <h1>Confrim deleting {{$category->title}}</h1>
    <p>Are you sure you want to delete this album?</p>
    <button type="submit">Confirm</button>
</form>
@endisset


@isset($image)
<form action="/backend/post/{{$post_id}}/image/{{$image->id}}" method="POST">
    @csrf
    @method('DELETE')

    <img src="{{ $image->image }}" style="max-width: 200px;" alt="">
    <p>Are you sure you want to delete this extra image?</p>
    <button type="submit">Confirm</button>
</form>
@endisset

    
@endsection