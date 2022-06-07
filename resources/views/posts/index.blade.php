@extends('layouts.app')

@section('title', 'Welcome to ' . config('app.name') . ' blogging platform!')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h4>{{ __('Explore Posts') }} | <a class="btn-link" href="{{ request()->fullUrlWithQuery(['sort_by' => 'publication_date']) }}">Latest Published Posts</a> | <a class="btn-link" href="/posts/create">New Post +</a></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                @forelse($posts as $post)
                    <div class="col-md-6 my-2">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $post->title }}</h4>
                                <p>{{ $post->read_time }}</p>
                            </div>

                            <div class="card-body">
                                {{ $post->preview }}
                                <p><a class="btn-link" href="/posts/{{ $post->slug }}/read">Read more...</a></p>
                            </div>

                            <div class="card-footer">
                                <p>Published <strong>{{ $post->publication_date->diffForHumans() }}</strong>, By <strong>{{ $post->user->name }}</strong></p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            You haven't published any posts yet. <a class="btn-link" href="/posts/create">Go publish now >></a>
                        </div>
                    </div>
                @endforelse

                <div class="col-md-12">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
