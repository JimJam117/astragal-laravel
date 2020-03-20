<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function fetch() {
        $query = request()->input('query');

        return redirect("/search/" . $query);
    }

    public function show($search = null) {
        if ($search == null) {
            return redirect('/home');
        }

        $results_posts = \App\Post::where('description', 'LIKE', "%{$search}%")
                                    ->orWhere('body', 'LIKE', "%{$search}%")
                                    ->orWhere('title', 'LIKE', "%{$search}%")
                                    ->get();
        $results_categories = \App\Category::where('description', 'LIKE', "%{$search}%")
                                    ->orWhere('body', 'LIKE', "%{$search}%")
                                    ->orWhere('title', 'LIKE', "%{$search}%")
                                    ->get();

        return view('search.show', compact('search', 'results_posts', 'results_categories'));
    }

    public function show_api($search = null) {
        if ($search == null) {
            return redirect('/home');
        }

        $results_posts = \App\Post::where('description', 'LIKE', "%{$search}%")
                                    ->orWhere('body', 'LIKE', "%{$search}%")
                                    ->orWhere('title', 'LIKE', "%{$search}%")
                                    ->get();
        $results_categories = \App\Category::where('description', 'LIKE', "%{$search}%")
                                    ->orWhere('body', 'LIKE', "%{$search}%")
                                    ->orWhere('title', 'LIKE', "%{$search}%")
                                    ->get();

        return (compact('search', 'results_posts', 'results_categories'));
    }

}

