<?php

namespace App\Http\Controllers;
use App\Models\Post;

class PageController extends Controller
{

    public function show(){
               $posts = Post::all();
               return view("pending",['posts' => $posts]);
    }

}

