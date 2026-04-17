<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    


public function create(){
        return view("article.create");
    }


public function edit(Article $article){
       

        return view('article.edit', compact('article'));
    }




public function show(Article $article){
       

        return view('article.show', compact('article'));
    }




public function index(){
       
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('article.index', compact('articles'));
    }

public function destroy(Article $article)
{

    if (!Auth::user()->is_revisor) {
        abort(403, 'Azione non autorizzata.');
    }


    if ($article->images->isNotEmpty()) {
        foreach ($article->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
    }

    $article->delete();


    return redirect()->route('homepage')->with('message', "L'articolo $article->title è stato eliminato definitivamente.");
}

public function byCategory(Category $category){


         $articles = $category->articles->where('is_accepted', true);
         return view('article.byCategory', ['articles' => $category->articles, 'category' => $category]);
}


}



