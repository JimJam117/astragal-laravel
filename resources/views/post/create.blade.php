@extends('layouts.base')
@section('content')
<h1>Create Post:</h1>
<form action="/post" method="post" enctype="multipart/form-data">
    @csrf
    <div class=" form-group row">
        <label for="title">Title</label>
        <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title"
            value="{{ old('title') }}" required>

        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group row">
        <label for="slug">slug</label>
        <input id="slug" type="slug" class="form-control @error('slug') is-invalid @enderror" name="slug"
            value="{{ old('slug') }}" required>

        @error('slug')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group row">
        <label for="category_id">Project</label>
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

    <div class="form-group row">
      <label for="created_at_manual">Created At</label>
      <p>Example</p>
      <p>2020-01-27 15:30:49</p>
      <br>
      <input id="created_at_manual" type="created_at_manual" class="form-control @error('created_at_manual') is-invalid @enderror" name="created_at_manual"
            value="{{ old('created_at_manual') }}" required>

      @error('created_at_manual')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class=" form-group row">
        <label for="body">Body</label>
        <br><br>
        <textarea class="form-control @error('body') is-invalid @enderror" type="text" name="body">{{old('body')}}</textarea>

        @error('body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="row form-group">
        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
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
@endsection

@section('extra-scripts')
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
    // file_browser_callback : function(field_name, url, type, win) {
    //   var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    //   var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
    //   var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
    //   if (type == 'image') {
    //     cmsURL = cmsURL + "&type=Images";
    //   } else {
    //     cmsURL = cmsURL + "&type=Files";
    //   }
    //   tinyMCE.activeEditor.windowManager.open({
    //     file : cmsURL,
    //     title : 'Filemanager',
    //     width : x * 0.8,
    //     height : y * 0.8,
    //     resizable : "yes",
    //     close_previous : "no"
    //   });
    // }
  };
  tinymce.init(editor_config);
</script>

@endsection