<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index(){
        $posts = Post::search()
            ->latest("id")
            ->with(['user','category'])
            ->paginate(10)
            ->withQueryString();

//        return $posts;
        return response()->json($posts);
    }

    public function detail($slug){
//        return $slug;
        $post = Post::where('slug',$slug)->first();
//        return $post;
        return response()->json($post);

    }
}
