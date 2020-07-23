@if (count($breadcrumbs))
    <div id="breadcrumb">
        <div class="container">
            <ul>
                @foreach ($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                        <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                        <li>{{ $breadcrumb->title }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endif
