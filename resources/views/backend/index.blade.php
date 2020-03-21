@extends('layouts.backend')

@section('content')

  
    <h1 class="page-header"><svg class="svg-inline--fa fa-wrench fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="wrench" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M507.73 109.1c-2.24-9.03-13.54-12.09-20.12-5.51l-74.36 74.36-67.88-11.31-11.31-67.88 74.36-74.36c6.62-6.62 3.43-17.9-5.66-20.16-47.38-11.74-99.55.91-136.58 37.93-39.64 39.64-50.55 97.1-34.05 147.2L18.74 402.76c-24.99 24.99-24.99 65.51 0 90.5 24.99 24.99 65.51 24.99 90.5 0l213.21-213.21c50.12 16.71 107.47 5.68 147.37-34.22 37.07-37.07 49.7-89.32 37.91-136.73zM64 472c-13.25 0-24-10.75-24-24 0-13.26 10.75-24 24-24s24 10.74 24 24c0 13.25-10.75 24-24 24z"></path></svg><!-- <i class="fas fa-wrench"></i> --> General Settings Menu</h1>
  
    <form method="post" enctype="multipart/form-data">
      <table class="form_table">
        <tbody><tr class="form-group">
          <td><h3 class="sub-header"><svg class="svg-inline--fa fa-font fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="font" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M432 416h-23.41L277.88 53.69A32 32 0 0 0 247.58 32h-47.16a32 32 0 0 0-30.3 21.69L39.41 416H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16h-19.58l23.3-64h152.56l23.3 64H304a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM176.85 272L224 142.51 271.15 272z"></path></svg><!-- <i class="fas fa-font"></i> --> Blog Title</h3><p>Give your blog a catchy cool title (or just use your name, I'm not really that bothered).</p> </td>
          <td></td>
          <td><input required="" class="form-control" type="text" name="main_text" minlength="3" maxlength="20" value="Astra London"></td>
        </tr>
  
        <tr><td><hr></td><td></td><td><hr></td></tr>
        <tr class="form-group">
          <td><h3 class="sub-header"><svg class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path></svg><!-- <i class="fas fa-quote-left"></i> --> Subtitle</h3><p>Sum up what your blog is about in a few words or a short sentence.</p> </td>
          <td></td>
          <td><input required="" class="form-control" type="text" name="sub_text" minlength="3" maxlength="20" value="Portfolio Gallery"></td>
        </tr>
  
        <tr><td><hr></td><td></td><td><hr></td></tr>
        <tr class="form-group">
          <td><h3 class="sub-header"><svg class="svg-inline--fa fa-image fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="image" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z"></path></svg><!-- <i class="fas fa-image"></i> --> Replace Background Image (jpg, png)</h3>
            <p>You can upload a custom image here to use as the background for the landing page and title areas.</p></td>
            <td></td>
            <td><br><input id="bk_file" class="inputfile" type="file" name="bk_file">  <br>  <label for="bk_file">Choose a file</label></td>
          </tr>
          <tr class="form-group">
            <td></td>
            <td></td>
            <td><p class="sub-header">Current Image:</p><div class="editpost_img_preview" style="background-image: url('img/uploads/pref/background_picture.5e21d4324e79d9.93636855.jpeg');">
            </div></td>
          </tr>
          <tr><td><hr></td><td></td><td><hr></td></tr>
  
          <tr class="form-group">
            <td>
              <h3 class="sub-header"><svg class="svg-inline--fa fa-user fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path></svg><!-- <i class="fas fa-user"></i> --> Replace Profile Image (jpg, png)</h3>
              <p>This is the image that will appear on the sidebar above the blog title.</p>
            </td>
            <td></td>
            <td><br> <input id="pp_file" class="inputfile" type="file" name="pp_file">  <br>  <label for="pp_file">Choose a file</label></td>
  
          </tr>
  
          <tr class="form-group">
            <td></td>
            <td></td>
            <td><p class="sub-header">Current Image:</p><div class="editpost_img_preview" style="background-image: url('img/uploads/pref/profile_picture.5e21d3caa96024.91370977.jpeg');"></div></td>
          </tr>
  
          <tr class="form-group">
            <td>
              <br>
            </td>
          </tr>
  
          <tr><td>
            <div class="form-group">
              <button class="btn" name="submit" type="submit">Update</button>
            </div>
          </td>
        </tr>
      </tbody></table>
  
      <br>
  
    </form>

@endsection