@extends('layouts.app')

@section('title', 'Create a New Blog Post')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create a Blog Post') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('post.create') }}">
                        @csrf
                        <div class="form-group mb-5">
                            <label class="form-label visually-hidden" for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Article title" value="{{ old('title') }}" name="title" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <label class="form-label visually-hidden" for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" required>{{ old('description') }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-full mr-2">
                            {{ __('Publish Post') }}
                        </button>
                    </form>
                </div>

                <div class="card-footer">
                    You can also
                    <a class="btn-link" href="/">Explore All posts</a> or
                    <a class="btn-link" href="/home">See yours here</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
