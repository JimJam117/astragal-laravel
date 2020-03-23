<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Purifier;
use \App\Post;
use \App\Category;
use \App\Pref;
use \App\Image;

class BackendController extends Controller
{
    // purifier config 
    public $purifierAllowedElements = 'div,h1,h2,h3,h4,h5,h6,code,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]';


    // pagination and get posts/categories functions
    function paginatePosts($paginate) {
        return \App\Post::orderBy('created_at', 'DESC')->where("deleted_at", null)->paginate($paginate);
    }
    function paginateCategories($paginate){
        return \App\Category::orderBy('created_at', 'DESC')->where("deleted_at", null)->paginate($paginate);
    }
    private function allPosts(){
        return \App\Post::orderBy('created_at', 'DESC')->where("deleted_at", null)->get();
    } 
    private function allCategories() {
        return \App\Category::orderBy('created_at', 'DESC')->where("deleted_at", null)->get();
    }
    

    public function posts() {

        $posts = self::paginatePosts(5);
        $recent_post = $posts->first();

        $categories = self::allCategories();
        $recent_category = $categories->first();


        return view('backend.posts', compact('posts', 'categories', 'recent_category', 'recent_post'));
    }

    public function albums() {
        $posts = self::allPosts();
        $recent_post = $posts->first();

        $categories = self::paginateCategories(5);
        $recent_category = $categories->first();


        return view('backend.albums', compact('posts', 'categories', 'recent_category', 'recent_post'));
    }

    public function album($id) {
        if ($id == null) {
            return redirect("/backend/albums");
        }
        $category = Category::where("id", $id)->whereNull('deleted_at')->firstOrFail();

        $posts = Post::orderBy('created_at', 'DESC')->where("deleted_at", null)->where("category_id", $id)->paginate(5);


        return view('backend.album', compact('posts', 'category'));
    }

    // Add and edit post

    public function addPost() {
        $categories = self::allCategories();

        return view('backend.addPost', compact('categories'));
    }

    public function editPost($id) {
        // get user and authorize
        $post = \App\Post::where('id', $id)->firstOrFail();
        $images = Image::where('post_id', $id)->get();

        $categories = self::allCategories();

        return view('backend.editPost', compact('post', 'categories', 'images'));
    }

    public function addAlbum() {
        return view('backend.addAlbum');
    }

    public function editAlbum($id) {
        // get user and authorize
        $category = \App\Category::where('id', $id)->firstOrFail();

        return view('backend.editAlbum', compact('category'));
    }



    /**
     * Store post
     * 
     */
    public function storePost(){
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'nullable',
            'image' => 'image|required',
        ]);

        $purified_body = Purifier::clean($data['body'], array('HTML.Allowed' => $this->purifierAllowedElements));

        if ($data['image']) {
            $imgPath = request('image')->store('uploads', 'public');

            // adds the storage dir to the front of the path
            $imgPathWithStorage = '/storage/' . $imgPath;

            auth()->user()->posts()->create([
                'title' => $data['title'],
                'body' => $purified_body,
                'category_id' => $data['category_id'],
                'image' => $imgPathWithStorage,
            ]);
        }
        else{ return "error with image upload"; }


        return redirect("/backend/posts");
    }


    /*
    * Update post
    * 
    */
   public function updatePost($id){
        // get user and authorize
        $post = \App\Post::where('id', $id)->whereNull('deleted_at')->firstOrFail();

       $data = request()->validate([
           'title' => 'required',
           'body' => 'required',
           'category_id' => 'nullable',
           'image' => 'image',
           'image_extra' => 'image'
       ]);

       $purified_body = Purifier::clean($data['body'], array('HTML.Allowed' => $this->purifierAllowedElements));

       if (request('image')) {
           $imgPath = request('image')->store('uploads', 'public');

           // adds the storage dir to the front of the path
           $imgPathWithStorage = '/storage/' . $imgPath;

           $post->update([
               'title' => $data['title'],
               'body' => $purified_body,
               'category_id' => $data['category_id'],
               'image' => $imgPathWithStorage,
           ]);
       }
       else{
        $post->update([
            'title' => $data['title'],
            'body' => $purified_body,
            'category_id' => $data['category_id'],
        ]);
       }

       if (request('image_extra')) {
            $imgPath = request('image_extra')->store('uploads', 'public');

            // adds the storage dir to the front of the path
            $imgPathWithStorage = '/storage/' . $imgPath;

            Image::create([
                'post_id' => $id,
                'image' => $imgPathWithStorage,
            ]);
        }


        $images = Image::where('post_id', $id)->get();
        $categories = self::allCategories();
        $success_message = "$post->title updated successfully!";
       return view("backend.editPost", compact('categories', 'images', 'post', 'success_message'));
   }



    /**
     * Store album
     * 
     */
    public function storeAlbum(){
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image|required',
        ]);

        $purified_body = Purifier::clean($data['body'], array('HTML.Allowed' => $this->purifierAllowedElements));

        if ($data['image']) {
            $imgPath = request('image')->store('uploads', 'public');

            // adds the storage dir to the front of the path
            $imgPathWithStorage = '/storage/' . $imgPath;

            Category::create([
                'title' => $data['title'],
                'body' => $purified_body,
                'image' => $imgPathWithStorage,
            ]);
        }
        else{ return "error with image upload"; }

        return redirect("/backend/albums");
    }


    /*
    * Update album
    * 
    */
   public function updateAlbum($id){
    // get user and authorize
    $category = Category::where('id', $id)->whereNull('deleted_at')->firstOrFail();

   $data = request()->validate([
       'title' => 'required',
       'body' => 'required',
       'image' => 'image',
   ]);

   $purified_body = Purifier::clean($data['body'], array('HTML.Allowed' => $this->purifierAllowedElements));

   if (request('image')) {
       $imgPath = request('image')->store('uploads', 'public');

       // adds the storage dir to the front of the path
       $imgPathWithStorage = '/storage/' . $imgPath;

       $category->update([
           'title' => $data['title'],
           'body' => $purified_body,
           'image' => $imgPathWithStorage,
       ]);
   }
   else{
    $category->update([
        'title' => $data['title'],
        'body' => $purified_body,
    ]);
   }
   
   return redirect("/backend/albums");
}








    public function about() {
        dd(Post::all());
        return view('backend.about');

    }

    public function delete_confirm_post($id) {
        $post = \App\Post::where('id', $id)->whereNull('deleted_at')->firstOrFail();
        return view('confirm-delete', compact('post'));
   }

    public function delete_confirm_album($id) {
        $category = \App\Category::where('id', $id)->whereNull('deleted_at')->firstOrFail();
        return view('confirm-delete', compact('category'));
   }

   public function destroy_post($id) {
    $post = \App\Post::where('id', $id)->whereNull('deleted_at')->firstOrFail();
    $post->delete();
    return redirect('/backend/posts');
   }

   public function destroy_album($id) {
    $category = \App\Category::where('id', $id)->whereNull('deleted_at')->firstOrFail();
    $category->delete();
    return redirect('/backend/albums');
   }




   // homepage / general stuff

   public function prefInit() {
    $result = Pref::first();
    if (!$result) 
    {
        Pref::create([
            'main_text'                         => 'Blog Title',
            'sub_text'                          => 'Blog Subtitle',
            'background_image_location'         => '/storage/uploads/def_bk.jpeg',
            'profile_pic_location'              => '/storage/uploads/def_pp.jpeg',
            'landing_page_title'                => 'Landing Page Title',
            'landing_page_text'                 => 'Landing Page Text',
            'about_section'                     => 'About section',
            'number_of_recent_posts_to_display' => 5,
            'Featured_Image_1_Gal_ID'           => 0,
            'Featured_Image_2_Gal_ID'           => 0,
            'Featured_Image_3_Gal_ID'           => 0,
            'facebook_link'                     => 'https://facebook.com',
            'email_address'                     => 'test@test.com',
            'instagram_link'                    => 'https://facebook.com',
            'bool_is_facebook_enabled'          => false,
            'bool_is_email_enabled'             => false,
            'bool_is_instagram_enabled'         => false,
            'bool_is_aboutme_enabled'           => true,
            'bool_is_landingsubtext_enabled'    => true
        ]);
        $result = Pref::first();
     }

     return $result;
   }

   
    public function delete_confirm_image($post_id, $id) {
        $image = Image::where('id', $id)->firstOrFail();
        return view('confirm-delete', compact('image', 'post_id'));
    }

    public function destroy_image($post_id, $id) {
        $image = Image::where('id', $id)->firstOrFail();
        $image->delete();
        return redirect("/backend/post/$post_id/edit");

    }












   // general settings
   public function index() {

        $pref = self::prefInit();

        return view('backend.index', compact('pref'));
    }

    // homepage settings
    public function homepage() {
        $pref = self::prefInit();

        return view('backend.homepage', compact('pref'));
    }

    public function updateIndex(){
        // get user and authorize
        $pref = Pref::first();
    
       $data = request()->validate([
           'main_text' => 'required',
           'sub_text' => 'required',
           'background_image_location' => 'image',
           'profile_pic_location' => 'image',
       ]);
    
       $purified_main = Purifier::clean($data['main_text'], array('HTML.Allowed' => $this->purifierAllowedElements));
       $purified_sub = Purifier::clean($data['sub_text'], array('HTML.Allowed' => $this->purifierAllowedElements));

       // if the request contains a background image
       if (request('background_image_location')) {
           $imgPath = request('background_image_location')->store('uploads', 'public');
    
           // adds the storage dir to the front of the path
           $imgPathWithStorage = '/storage/' . $imgPath;
           $pref->update([ 'background_image_location' => $imgPathWithStorage ]);
       }

        // if the request contains a profile image
        if (request('profile_pic_location')) {
            $imgPath = request('profile_pic_location')->store('uploads', 'public');
        
            // adds the storage dir to the front of the path
            $imgPathWithStorage = '/storage/' . $imgPath;
            $pref->update([ 'profile_pic_location' => $imgPathWithStorage ]);
        }

        $pref->update([
            'main_text' => $purified_main,
            'sub_text' => $purified_sub,
        ]);        
    
       
       return redirect("/backend");
    }



    public function updateHomepage(){
        // get user and authorize
        $pref = Pref::first();
    
       $data = request()->validate([
           'landing_page_title' => 'required',
           'landing_page_text' => 'required',
           'about_section' => 'required',
       ]);
    
       $purified_landing_title = Purifier::clean($data['landing_page_title'], array('HTML.Allowed' => $this->purifierAllowedElements));
       $purified_landing_text  = Purifier::clean($data['landing_page_text'], array('HTML.Allowed' => $this->purifierAllowedElements));
       $purified_about_section = Purifier::clean($data['about_section'], array('HTML.Allowed' => $this->purifierAllowedElements));


        $pref->update([
            'landing_page_title' => $purified_landing_title,
            'landing_page_text' => $purified_landing_text,
            'about_section' => $purified_about_section,
        ]);        
    
       
       return redirect("/backend/homepage");
    }

}


