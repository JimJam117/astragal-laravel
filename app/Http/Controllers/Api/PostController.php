<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::All();
        $recent_post = $posts->first();

        $categories = Post::All();
        $recent_category = $categories->first();

        return response()->json([$posts, $recent_category, $recent_post]);
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
    public function show($id)
    {
        // if the post is null return a redirect
        if ($id == null) {
            return response()->error("Error");
        }

        //grab the post
        $id = \App\Post::where("slug", $id)->whereNull('deleted_at')->firstOrFail();

        // grab the most recent post, if it is the same as the $id then find the next most recent one
        $ids = Post::All();
        $recent_post = $ids->first();
        foreach ($ids as $item) {
            if($item->slug != $id->slug) {
                $recent_post = $item;
                break;
            }
        }


        $category = null;
        if($id->category != null) {
            $category = $id->category;
        }

        return response()->json([$post, $recent_post, $recent_category]);
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
