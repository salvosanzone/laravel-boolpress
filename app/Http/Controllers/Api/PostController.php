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

    // creo una funzione che mi restituisce un json con le categorie
    public function getPostsByCategory($slug_category){

      // inserendo ->with('posts') mi stampa tutti i post che hanno lo slung che ho inserito nell url
      $category = Category::where('slug', $slug_category)->with('posts.tags')->first();

      $success = true;
      $error = '';


      
      if(!$category){
        $success = false;
        $error = 'La categoria non esiste';
      }elseif($category && count($category['posts']) === 0){
        $success = false;
        $error = 'Non esistono post per questa categoria';

      }

      return response()->json(compact('success', 'error', 'category'));

      //dd(empty($category['posts']));
    }

    public function getPostsByTag($slug_tag){

      // gli sto dicendo tramite eloquent di prendere lo slug che è uguale a quello che gli inserirò io come parametro (select slug from Tag where slug = 'quello che inserisco io')
      $tag = Tag::where('slug', $slug_tag)->with('posts')->first();

      $success = true;
      $error = '';

      if (!$tag) {
        $success = false;
        $error = 'Il tag non esiste';
      }elseif($tag && count($tag['posts']) === 0){
        $success = false;
        $error = 'Non esistono post per questo tag';
      }

      return response()->json(compact('tag', 'error', 'success'));
    }

}
