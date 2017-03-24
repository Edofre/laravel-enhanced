{{ link_to(route('front.news.index'), trans('front.all_news'), ['class' => $title == trans('front.all_news') ? 'btn btn-active' : 'btn btn-primary']) }}
@foreach($newsCategories as $newsCategory)
    {{ link_to(route('front.news.category', ['item' => $newsCategory]), $newsCategory->name, ['class' => $title == $newsCategory->name ? 'btn btn-active' : 'btn btn-primary']) }}
@endforeach