@extends('layouts.backend')

@section('content')
<h1 class="page-header page-header-resposive"><svg class="svg-inline--fa fa-plus-square fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus-square" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-32 252c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92H92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"></path></svg><!-- <i class="fas fa-plus-square"></i> --> Create Post</h1>
<br>
<form action="/backend/post" method="post" enctype="multipart/form-data">
    @csrf
    <div class=" form-group row">
        <label for="title">Post Title:</label>
        <br>
        <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title"
            value="{{ old('title') }}" required>

        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group row">
        <label for="category_id">Album:</label>
        <br>
        <select id="category_id" type="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id"
        value="{{ old('category_id') }}" >
            <option value="0">None</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
          </select>

        @error('category_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class=" form-group row">
        <label for="body">Post Body:</label>
        <br><br>
        <textarea class="form-control @error('body') is-invalid @enderror" type="text" name="body">{{old('body')}}</textarea>

        @error('body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="row form-group">
        <label for="image" class="col-md-4 col-form-label text-md-right">Post Image:</label>
        <div class="col-md-6">
            <input type="file" class="form-control-file" id="image" name="image" required>
            @error('image')
            <strong>{{ $message }}</strong>
            @enderror
        </div>

    </div> 

    <div class="form-group row mb-0">
        <button class="btn btn-primary text-center align-items-center" type="submit" name="button">Add New Post</button>
    </div>
</form>
<hr>


<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>
  var editor_config = {
    forced_root_block : false,
    path_absolute : "/",
    selector: "textarea",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
  };
  tinymce.init(editor_config);
</script>

@endsection