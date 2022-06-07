<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Services\Caching\PaginatedPostCache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PaginatedPostCache $paginatedPostCache
     * @return Application|Factory|View
     */
    public function index(PaginatedPostCache $paginatedPostCache): View|Factory|Application
    {
        $filteredPostsQuery = Post::filteredPostsQuery(Post::query());

        return view('posts.index', [
            'posts' => $paginatedPostCache->getPosts($filteredPostsQuery)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return RedirectResponse
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        auth()->user()
            ->posts()
            ->create($request->validated());

        return back()->with([
            'status' => 'success',
            'message' => 'Your post has been published!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return Application|Factory|View
     */
    public function show(Post $post): View|Factory|Application
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
