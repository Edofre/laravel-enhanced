<div class="form-group col-sm-6">
    {!! Form::select('news_category_id', $newsCategories, !is_null($newsCategory) ? $newsCategory->slug : null, ['class' => 'form-control', 'id' => 'newsCategoryFilter', 'placeholder' => trans('front.all_categories')]) !!}
</div>

@section('js_footer')
    <script type="text/javascript">
        $("#newsCategoryFilter").change(function () {
            window.location.replace('/news/' + $(this).val());
        });

        $(document).ready(function () {
            $('#newsCategoryFilter').select2({
                placeholder: "{{ trans('front.filter_news') }}",
                allowClear: true,
                theme: "bootstrap",
            });
        });
    </script>
@endsection