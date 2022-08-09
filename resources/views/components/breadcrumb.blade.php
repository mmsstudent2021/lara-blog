<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

        @foreach($links as $key=>$value)
            @if($loop->last)
                <li class="breadcrumb-item text-capitalize active" aria-current="page">{{ $key }}</li>
            @else
                <li class="breadcrumb-item text-capitalize"><a href="{{ $value }}">{{ $key }}</a></li>
            @endif
        @endforeach

    </ol>
</nav>
