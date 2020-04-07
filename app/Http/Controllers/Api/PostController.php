<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Post;
use \App\Category;

class PostController extends Controller
{

    function paginatePosts($paginate) {
        return \App\Post::orderBy('updated_at', 'DESC')->where("deleted_at", null)->paginate($paginate);
    }

    public function get_paginated_posts() {
        $posts = self::paginatePosts(12);
        $recent_post = $posts->first();

        $categories = Category::orderBy('updated_at', 'DESC')->where("deleted_at", null)->get();
        $recent_category = $categories->first();

        return response()->json(["posts"=>$posts, "recent_category"=>$recent_category, "recent_post"=>$recent_post]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->where("deleted_at", null)->get();
        $recent_post = $posts->first();

        $categories = Category::orderBy('updated_at', 'DESC')->where("deleted_at", null)->get();
        $recent_category = $categories->first();

        return response()->json(["posts"=>$posts, "recent_category"=>$recent_category, "recent_post"=>$recent_post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        // if the post is null return a redirect
        if ($post == null) {
            return response()->error("Error");
        }

        //grab the post
        $post = \App\Post::where("id", $post)->whereNull('deleted_at')->firstOrFail();

        // grab the most recent post, if it is the same as the $id then find the next most recent one
        $posts = Post::All();
        $recent_post = $posts->first();
        foreach ($posts as $item) {
            if($item->slug != $post->slug) {
                $recent_post = $item;
                break;
            }
        }


        $category = null;
        if($post->category != null) {
            $category = $post->category;
        }

        return response()->json(["post"=>$post, "category"=>$category, "recent_post"=>$recent_post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
