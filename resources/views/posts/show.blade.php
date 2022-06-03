@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4>{{ __('Go back to all Posts') }} <a class="btn-link" href="/"><< All posts</a></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">{{ $post->title }} | {{ $post->read_time }}</div>

                <div class="card-body">
                    <p>Published on <strong>{{ $post->publication_date->diffForHumans() }}</strong>, By <strong>{{ $post->user->name }}</strong></p>

                    <p>{{ $post->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
