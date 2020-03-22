<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Purifier;
use \App\Post;
use \App\Category;

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
    



    public function index() {
        return view('backend.index');
    }

    public function homepage() {
        return view('backend.homepage');
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






    public function about() {
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

}


