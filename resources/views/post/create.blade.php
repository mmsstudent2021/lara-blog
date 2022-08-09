@extends('layouts.app')
@section("content")

    <x-breadcrumb :links="$links" />

    <x-card>
        <x-slot:title>Create Post</x-slot:title>
        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-input name="title" label="Post Title" />
            <div class="mb-3">
                <label class="form-label" for="category">Select Category</label>
                <select
                    type="text"
                    class="form-select @error('category') is-invalid @enderror"
                    name="category"
                    id="category"
                >
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ $category->id == old('category') ? 'selected':'' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error("category")
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <x-input type="file" name="photos" label="Post Photo" multiple="true" />

            <div class="mb-3">
                <label class="form-label" for="description">Post Description</label>
                <textarea
                    type="text"
                    class="form-control @error('description') is-invalid @enderror"
                    rows="10"
                    name="description"
                    id="description"
                >{{ old('description') }}</textarea>
                @error("description")
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <x-input type="file" name="featured_image" label="Feature Image" />
                <button class="btn btn-lg btn-primary">Create Post</button>
            </div>
        </form>
    </x-card>
@endsection
