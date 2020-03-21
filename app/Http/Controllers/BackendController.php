<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index() {
        return view('backend.index');
    }

    public function homepage() {
        return view('backend.homepage');
    }

    public function posts() {
        return view('backend.posts');
    }

    public function albums() {
        return view('backend.albums');
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
