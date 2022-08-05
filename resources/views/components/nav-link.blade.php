<a
    class="nav-link {{ request()->url() === $url ? 'active' : '' }}"
    href="{{ $url }}"
>
    {{ $name }}
</a>
