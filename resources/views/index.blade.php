@extends('master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <h1 class="text-center">Blog Posts (Hein Htet Zan)</h1>

                <div class="">
                    <form class="my-3" method="get">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control">
                            <button class="btn btn-primary">
                                Search
                            </button>
                        </div>
                    </form>
                    @isset($category)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p>Filter By : {{ $category->title }}</p>
                            <a href="{{ route('page.index') }}" class="btn  btn-outline-primary">See All</a>
                        </div>
                    @endisset
                </div>

                @forelse($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3>{{ $post->title }}</h3>
                            <div class="">
                                <a href="{{ route('page.category',$post->category->slug) }}" >
                                    <span class="badge bg-secondary">
                                        {{ $post->category->title }}
                                    </span>
                                </a>
                            </div>
                            <p class="my-3">
                                {{ $post->excerpt }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <p class="mb-0">{{ $post->user->name }}</p>
                                    <p class="mb-0">{{ $post->created_at->diffforHumans() }}</p>
                                </div>
                                <a href="{{ route('page.detail',$post->slug) }}" class="btn btn-primary">
                                    See More
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="card">
                        <div class="card-body">
                            <h1>There is no posts Yet !</h1>
                        </div>
                    </div>
                @endforelse


            </div>
            <div class="col-lg-8">
                {{ $posts->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@stop
