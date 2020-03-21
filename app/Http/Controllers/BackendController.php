<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\Category;

class BackendController extends Controller
{

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

    public function post() {
        return view('backend.post');
    }

    public function album() {
        return view('backend.album');
    }

    public function addPost() {
        return view('backend.addPost');
    }

    public function addAlbum() {
        return view('backend.addAlbum');
    }

    public function editPost() {
        return view('backend.editPost');
    }

    public function editAlbum() {
        return view('backend.editAlbum');
    }

    public function about() {
        return view('backend.about');
    }
}
