<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $posts = Post::getPostsFromQuery(auth()->user()->posts());

        return view('home', [
            'posts' => $posts->paginate('10')->withQueryString()
        ]);
    }
}
