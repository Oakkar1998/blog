<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\View;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request){
        // $articles = Article::orderBy('created_at','desc')->paginate(3);
        // dd($articles->toArray());

        

        $query = Article::query();

        // Search by title 
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Sort by order
        if ($request->order == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // default: latest
        }
        

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by author
        if ($request->filled('author')) {
            $query->where('author', $request->author);
        }
        


        $articles = $query->withCount('views')->paginate(9);


        // Get categories and authors for dropdowns
        $categories = Category::all();
        $authors = Article::select('author')->distinct()->orderBy('author')->get();

        return view('welcome',compact('articles','categories','authors'));
    }  
}