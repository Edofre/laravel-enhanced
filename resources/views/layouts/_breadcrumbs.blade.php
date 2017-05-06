@if(!empty($breadcrumbs))
    <ol class="breadcrumb well well-sm">
        @php
            $keys = array_keys($breadcrumbs);
            $last_key = array_pop($keys);
        @endphp
        @foreach($breadcrumbs as $key => $breadcrumb)
            @if($last_key == $key)
                <li class="active">
                    {{ $breadcrumb['name'] }}
                </li>
            @else
                <li>
                    <a href="{{ $breadcrumb['route'] }}">{{ $breadcrumb['name'] }}</a>
                </li>
            @endif
        @endforeach
    </ol>
@endif