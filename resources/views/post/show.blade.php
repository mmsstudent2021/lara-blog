@extends('layouts.app')
@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Post</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post Detail</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4>{{ $post->title }}</h4>
            <hr>
            <div class="mb-3">
                <span class="badge bg-secondary">
                    <i class="bi bi-grid"></i>
                    {{ $post->category->title }}
                </span>

                <span class="badge bg-secondary">
                    <i class="bi bi-person"></i>
                    {{ $post->user->name }}
                </span>

                <span class="badge bg-secondary">
                    <i class="bi bi-calendar"></i>
                    {{ $post->created_at->format("d M Y") }}
                </span>
                <span class="badge bg-secondary">
                    <i class="bi bi-clock"></i>
                    {{ $post->created_at->format("h : m A") }}
                </span>
            </div>

            @isset($post->featured_image)
                <img src="{{ Storage::temporaryUrl($post->featured_image,now()->addMinutes(5)) }}" height="100" class="rounded  mb-3" alt="">
            @endisset

            <p>
                {{ $post->description }}
            </p>

            @foreach($post->photos as $photo)
                <img src="{{ Storage::url($photo->name) }}" height="100" class="rounded  mb-3" alt="">
            @endforeach

            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('post.create') }}" class="btn btn-outline-primary">Create New Post</a>
                <a href="{{ route('post.index') }}" class="btn btn-primary">All Posts</a>
            </div>
        </div>
    </div>
@endsection
