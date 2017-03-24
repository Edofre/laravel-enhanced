<a href="{{ route('front.news.show', ['item' => $item]) }}" class="thumbnail">
    <img alt="{{ $item->title }}" width="200px" class="img-responsive" src="{{ route('image', ['image' => $item->front_image_url]) }}">
    <div class="caption">
        <h3>{{ $item->title }}</h3>
        <p>@html($item->frontIntro)</p>
    </div>
</a>