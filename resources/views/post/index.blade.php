@extends('layouts.app')
@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage Post</li>
        </ol>
    </nav>
    <x-card>
        <x-slot:title>Post List</x-slot:title>
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                @if(request('keyword'))
                    <span class="mb-0">Search By : " {{ request('keyword') }} "</span>
                    <a href="{{ route('post.index') }}">
                        <i class="bi bi-trash3"></i>
                    </a>
                @endif
            </div>
            <form action="{{ route('post.index') }}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="keyword" required>
                    <button class="btn btn-secondary">
                        <i class="bi bi-search"></i>
                        Search
                    </button>
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th class="w-25">Title</th>
                <th>Category</th>
                @if(Auth::user()->role != 'author')
                    <th>Owner</th>
                @endif
                <th>Control</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        {{ $post->title }}
                    </td>
                    <td>
                        {{ $post->category_id }}
                    </td>
                    @notAuthor
                    <td>
                        {{ $post->user->name }}
                    </td>
                    @endnotAuthor
                    <td>
                        <a href="{{ route('post.show',$post->id) }}" class="btn btn-sm btn-outline-dark">
                            <i class="bi bi-info-circle"></i>
                        </a>
                        @can("update",$post)
                            <a href="{{ route('post.edit',$post->id) }}" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-pencil"></i>
                            </a>
                        @endcan
                        @can("delete",$post)

                            @trash
                            <form action="{{ route('post.destroy',[$post->id,"delete"=>"force"]) }}" class="d-inline-block" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>

                            <form action="{{ route('post.destroy',[$post->id,"delete"=>"restore"]) }}" class="d-inline-block" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-recycle"></i>
                                </button>
                            </form>
                            @else

                            <form action="{{ route('post.destroy',[$post->id,"delete"=>"soft"]) }}" class="d-inline-block" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>

                            @endtrash
                        @endcan

                    </td>
                    <td>
                        {!! $post->time !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">There is no post</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="">
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </x-card>
@endsection
