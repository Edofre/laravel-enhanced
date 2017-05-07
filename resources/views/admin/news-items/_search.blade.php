<div class="pull-right">
    {!! Form::open(['method'=>'GET', 'route' =>  [\Request::route()->getName(), 'newsItem' => $newsItem], 'class'=>'form-inline form-group','role'=>'search']) !!}
    {!! Form::select('news_category_id', $newsItem->getSelectedFormData('news_category_id', 'name', \App\Models\NewsCategory::class), $newsItem->news_category_id, ['id'=>'news_category_id','class' => 'form-control', 'placeholder' => trans('common.select_model', ['model'=> strtolower(trans('newsItems.news_category_id'))])]) !!}
    <div class="input-group">
        {!! Form::text(\App\Models\Search\NewsItem::SEARCH_KEYWORD, $newsItem->search_keyword, ['class' => 'form-control', 'placeholder' => trans('common.search...')]) !!}
        <span class="input-group-btn">
            {!! Form::button('<i class="glyphicon glyphicon-search"></i>', ['type'=>'submit','class' => 'btn btn-primary']) !!}
            <a href="{!! url()->current() !!}" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
        </span>
    </div>
    {!! Form::close() !!}
</div>
@section('js_footer')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#news_category_id').select2({
                placeholder: "{{ trans('common.select_model', ['model'=> strtolower(trans('newsItems.news_category_id'))]) }}",
                allowClear: true,
                theme: "bootstrap",
                ajax: {
                    url: "/admin/newsCategories/ajax-form-data",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    results: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.text,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2
            });
        });
    </script>
@endsection