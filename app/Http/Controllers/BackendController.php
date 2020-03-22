<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Purifier;
use \App\Post;
use \App\Category;
use \App\Pref;

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

        $categories = self::allCategories();

        return view('backend.editPost', compact('post', 'categories'));
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

       return redirect("/backend/posts");
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
        self::prefInit();
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

}


