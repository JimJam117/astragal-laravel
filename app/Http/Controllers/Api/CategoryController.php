<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Category;
use \App\Post;

class CategoryController extends Controller
{
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

        return response()->json(["categories"=>$categories, "recent_category"=>$recent_category, "recent_post"=>$recent_post]);
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
    public function show($category)
    {
        if ($category == null) {
            return redirect("/albums");
        }
        $category = Category::where("id", $category)->whereNull('deleted_at')->firstOrFail();

        
        $recent_posts = Post::orderBy('updated_at', 'DESC')->where("deleted_at", null)->get();
        $recent_post = $recent_posts->first();

        // if recent posts is more than 3, cut it down to a max of 3
        if(count($recent_posts) > 3) {
            $newArray = [];
            $i = 0;
            foreach ($recent_posts as $item) {

                if($i < 3) { $newArray[] = $item; $i++;}
                else{ break;} 
            }

            $recent_posts = $newArray;
        }

        $categories = Category::orderBy('updated_at', 'DESC')->where("deleted_at", null)->get();
        $recent_category = $categories->first();        

        return response()->json(["category"=>$category, "recent_category"=>$recent_category, "recent_post"=>$recent_post, "recent_posts"=>$recent_posts]);
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
