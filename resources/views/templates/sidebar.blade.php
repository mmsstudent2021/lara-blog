<div class="mb-4">
    <form method="get">
        <div class="input-group">
            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control">
            <button class="btn btn-primary">
                Search
            </button>
        </div>
    </form>
</div>
<div class="mb-4">
    <h3>Category List</h3>
    <div class="list-group">
        <a href="{{ route('page.index') }}" class="list-group-item {{ route('page.index') === request()->url() ? 'active' : '' }}">
            All Categories
        </a>
        @foreach($categories as $category)
            <a href="{{ route('page.category',$category->slug) }}" class="list-group-item {{ route('page.category',$category->slug) === request()->url() ? 'active' : '' }}">
                {{ $category->title }}
            </a>
        @endforeach

    </div>
</div>
