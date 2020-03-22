@extends('layouts.backend')

@section('content')
<h1 class="page-header"><svg class="svg-inline--fa fa-folder-open fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="folder-open" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M572.694 292.093L500.27 416.248A63.997 63.997 0 0 1 444.989 448H45.025c-18.523 0-30.064-20.093-20.731-36.093l72.424-124.155A64 64 0 0 1 152 256h399.964c18.523 0 30.064 20.093 20.73 36.093zM152 224h328v-48c0-26.51-21.49-48-48-48H272l-64-64H48C21.49 64 0 85.49 0 112v278.046l69.077-118.418C86.214 242.25 117.989 224 152 224z"></path></svg><!-- <i class="fas fa-folder-open"></i> --> Albums</h1>

<div class="table">

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th class="thumbnailHideColumn">Thumbnail</th>
                <th class="actionsColumn">Actions</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($categories as $category)
            <tr>
                <td>
                    <h4>{{ $category->title }}</h4>
                </td>
                <td class="thumbnailHideColumn"
                    style="background-image: url('{{ $category->image }}'); background-size: contain; background-repeat: no-repeat;">
                </td>

                

                <td>
                    <a href="/album/{{ $category->id }}" class="btn btnBlock">View</a>
                    <a href="/backend/album/{{ $category->id }}/edit" class="btn btn-warning btnBlock">Edit</a>
                    <a href="/backend/album/{{ $category->id  }}" class="btn btnBlock">Details</a>
                    <a class="btn btn-danger btnBlock" href="/backend/album/{{$category->id}}/delete">Delete</a>
                       
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<br>

<div class="backend_pagination_container">
    {{ $categories->links() }}
</div>

<br><br>
<a class="btn" href="/backend/album/add">Create Album</a>


@endsection
