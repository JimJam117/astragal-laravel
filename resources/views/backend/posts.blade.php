@extends('layouts.backend')

@section('content')
<h1 class="page-header"><svg class="svg-inline--fa fa-images fa-w-18" aria-hidden="true" focusable="false"
        data-prefix="far" data-icon="images" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
        data-fa-i2svg="">
        <path fill="currentColor"
            d="M480 416v16c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V176c0-26.51 21.49-48 48-48h16v48H54a6 6 0 0 0-6 6v244a6 6 0 0 0 6 6h372a6 6 0 0 0 6-6v-10h48zm42-336H150a6 6 0 0 0-6 6v244a6 6 0 0 0 6 6h372a6 6 0 0 0 6-6V86a6 6 0 0 0-6-6zm6-48c26.51 0 48 21.49 48 48v256c0 26.51-21.49 48-48 48H144c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h384zM264 144c0 22.091-17.909 40-40 40s-40-17.909-40-40 17.909-40 40-40 40 17.909 40 40zm-72 96l39.515-39.515c4.686-4.686 12.284-4.686 16.971 0L288 240l103.515-103.515c4.686-4.686 12.284-4.686 16.971 0L480 208v80H192v-48z">
        </path>
    </svg><!-- <i class="far fa-images"></i> --> All Posts</h1>
<div class="table">

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th class="thumbnailHideColumn">Thumbnail</th>
                <th class="albumColumn">Album</th>
                <th class="actionsColumn">Actions</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($posts as $post)
            <tr>
                <td>
                    <h4>{{ $post->title }}</h4>
                </td>
                <td class="thumbnailHideColumn"
                    style="background-image: url('img/uploads/image.5e7510fa2789a4.69438516.png'); background-size: contain; background-repeat: no-repeat;">
                </td>

                @isset($post->category_id)
                    @php
                        $categoryName = "";
                        foreach ($categories as $category) {
                            if ($category == $post->category_id)
                            {
                                $categoryName = $category->title;
                            }
                        }
                    @endphp
                    <td class="albumColumn">{{ $categoryName }}</td> 
                @else
                    <td class="albumColumn">None</td>
                @endisset
                

                <td>
                    <a href="/post/{{ $post->id }}" class="btn btnBlock">View</a>
                    <a href="/backend/post/{{ $post->id }}/edit" class="btn btn-warning btnBlock">Edit</a>
                    <a class="btn btn-danger btnBlock"
                        onclick="javascript: return confirm('Please confirm deletion of this post');"
                        href="/backend/post/{{$post->id}}/delete-confirm';">Delete</a>
                    @isset($post->category_id)
                        <a href="/backend/album/{{$post->category_id}}" class="btn btn-green btnBlock">Album</a> 
                    @endisset
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<br>

<div class="backend_pagination_container">
    {{ $posts->links() }}
</div>

<br><br>
<a class="btn" href="/backend/post/add">Create Post</a>


@endsection
