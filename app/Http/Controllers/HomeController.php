<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\Caching\PaginatedPostCache;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param PaginatedPostCache $paginatedPostCache
     * @return Renderable
     */
    public function index(PaginatedPostCache $paginatedPostCache): Renderable
    {
        $filteredPostsQuery = Post::filteredPostsQuery(auth()->user()->posts());

        return view('home', [
            'posts' => $paginatedPostCache->getPosts($filteredPostsQuery)
        ]);
    }
}
