@extends('layouts.backend')

@section('content')
<div class="album_details_top">

    <br>
    <table class="form_table">
        <tbody>
            <tr>
                <td>
                    <h1><svg class="svg-inline--fa fa-folder-open fa-w-18" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="folder-open" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M572.694 292.093L500.27 416.248A63.997 63.997 0 0 1 444.989 448H45.025c-18.523 0-30.064-20.093-20.731-36.093l72.424-124.155A64 64 0 0 1 152 256h399.964c18.523 0 30.064 20.093 20.73 36.093zM152 224h328v-48c0-26.51-21.49-48-48-48H272l-64-64H48C21.49 64 0 85.49 0 112v278.046l69.077-118.418C86.214 242.25 117.989 224 152 224z">
                            </path>
                        </svg><!-- <i class="fas fa-folder-open"></i> --> Album "{{ $category->title }}" Details</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <h3><svg class="svg-inline--fa fa-file-image fa-w-12" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="file-image" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 384 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M384 121.941V128H256V0h6.059a24 24 0 0 1 16.97 7.029l97.941 97.941a24.002 24.002 0 0 1 7.03 16.971zM248 160c-13.2 0-24-10.8-24-24V0H24C10.745 0 0 10.745 0 24v464c0 13.255 10.745 24 24 24h336c13.255 0 24-10.745 24-24V160H248zm-135.455 16c26.51 0 48 21.49 48 48s-21.49 48-48 48-48-21.49-48-48 21.491-48 48-48zm208 240h-256l.485-48.485L104.545 328c4.686-4.686 11.799-4.201 16.485.485L160.545 368 264.06 264.485c4.686-4.686 12.284-4.686 16.971 0L320.545 304v112z">
                            </path>
                        </svg><!-- <i class="fas fa-file-image"></i> -->Album Cover:</h3>
                    <div class="alb_details_pic"
                        style="background-image: url('{{ $category->image }}'"
                        alt="All"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <h3><svg class="svg-inline--fa fa-pen fa-w-16" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="pen" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M290.74 93.24l128.02 128.02-277.99 277.99-114.14 12.6C11.35 513.54-1.56 500.62.14 485.34l12.7-114.22 277.9-277.88zm207.2-19.06l-60.11-60.11c-18.75-18.75-49.16-18.75-67.91 0l-56.55 56.55 128.02 128.02 56.55-56.55c18.75-18.76 18.75-49.16 0-67.91z">
                            </path>
                        </svg><!-- <i class="fas fa-pen"></i> -->Album Description:</h3>
                    {!! $category->body !!}
                </td>
            </tr>

            <tr>
                <td></td>
            </tr>

            <tr>
                <td class="alb_details_td_padding">
                    <a class="btn" href="/album/{{ $category->id }}">View Album</a>
                    <a class="btn btn-warning" href="/backend/album/{{ $category->id }}/edit">Edit Album</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<hr>
<br>

<h1 class="page-header"><svg class="svg-inline--fa fa-images fa-w-18" aria-hidden="true" focusable="false"
        data-prefix="far" data-icon="images" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
        data-fa-i2svg="">
        <path fill="currentColor"
            d="M480 416v16c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V176c0-26.51 21.49-48 48-48h16v48H54a6 6 0 0 0-6 6v244a6 6 0 0 0 6 6h372a6 6 0 0 0 6-6v-10h48zm42-336H150a6 6 0 0 0-6 6v244a6 6 0 0 0 6 6h372a6 6 0 0 0 6-6V86a6 6 0 0 0-6-6zm6-48c26.51 0 48 21.49 48 48v256c0 26.51-21.49 48-48 48H144c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h384zM264 144c0 22.091-17.909 40-40 40s-40-17.909-40-40 17.909-40 40-40 40 17.909 40 40zm-72 96l39.515-39.515c4.686-4.686 12.284-4.686 16.971 0L288 240l103.515-103.515c4.686-4.686 12.284-4.686 16.971 0L480 208v80H192v-48z">
        </path>
    </svg><!-- <i class="far fa-images"></i> --> Posts in Album</h1>
<div class="table">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th class="thumbnailColumn">Thumbnail</th>
                <th class="actionsColumn">Actions</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td class="thumbnailColumn"
                    style="background-image: url('{{ $post->image }}'); background-size: contain; background-repeat: no-repeat;">
                </td>

                <td>
                    <a href="/post/{{ $post->id }}" class="btn btnBlock">View</a>
                    <a href="/backend/post/{{ $post->id }}/edit" class="btn btn-warning btnBlock">Edit</a>
                    <a class="btn btn-danger btnBlock" href="/backend/post/{{ $post->id }}/delete">Delete</a>
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
<div class="backend_pagination_container">
    {{ $posts->links() }}
</div>
<br>
<hr><br>
<a class="btn btn-danger" href="/backend/albums">Back to Albums List</a>
@endsection
