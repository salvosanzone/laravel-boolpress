<?php

namespace App\Http\Controllers\Api;

// importo in model 
use App\Post;
use App\Category;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        // salvo in una variabile tutti i miei post
        $posts = Post::with(['category', 'tags'])->paginate(3);


        // salvo in una variabile tutte le categorie e i tags usando i model
        $categories = Category::all();

        $tags = Tag::all();

        // il return adesso non mi restituirà piu una view(blade) ma un json
        // posso passsare la variabile posts con il compact
        return response()->json(compact('posts', 'categories', 'tags'));

    }

    // generazione json del singolo post in dettaglio usando lo slug
    public function show($slug){
      $post = Post::where('slug', $slug)->with(['tags', 'category'])->first();
      return response()->json($post);
    }


}
