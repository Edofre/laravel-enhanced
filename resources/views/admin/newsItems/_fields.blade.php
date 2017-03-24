<div class="col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('is_public', trans('newsItems.is_public')) !!}
        {!! Form::checkbox('is_public', 1, old('is_public'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('news_category_id', trans('newsItems.news_category_id')) !!}
        {!! Form::select('news_category_id', $newsItem->getSelectedFormData('news_category_id', 'name', \App\Models\NewsCategory::class), old('news_category_id'), ['class' => 'form-control', 'placeholder' => trans('common.select_model', ['model'=> strtolower(trans('newsItems.news_category_id'))])]) !!}
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('title', trans('newsItems.title')) !!}
        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group col-sm-12">
        {!! Form::label('intro', trans('newsItems.intro')) !!}
        {!! Form::textArea('intro', old('intro'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-12">
        {!! Form::label('content', trans('newsItems.content')) !!}
        {!! Form::textArea('content', old('intro'), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="col-sm-12">
    <div class="form-group col-md-6">
        @if(!empty($newsItem->image_url))
            <div class="rw">
                @html($newsItem->getImage($newsItem->image_url, $newsItem->name, ['width' => '300px']))
                <p>{{ trans('common.uploading_new_file') }}</p>
            </div>
        @endif
        {!! Form::label('upload_file', trans('newsItems.image_url')) !!}
        {!! Form::file('upload_file', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="col-sm-12">
    <div class="form-group col-sm-12">
        {!! Form::label('tags', trans('newsItems.tags')) !!}
        <small>{{ trans('tags.info') }}</small>
        {!! Form::select('tags[]', $newsItem->getMultipleSelectFormData('tags', 'name'), $newsItem->getTagSelectData(), ['class' => 'form-control', 'id' => 'tags', 'style' => 'width:100%;', 'multiple']) !!}
    </div>
</div>

<div class="btn-group col-sm-12">
    {!! Form::submit(trans('common.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.newsItems.index') !!}" class="btn btn-default">{{ trans('common.cancel') }}</a>
</div>

@section('js_footer')
    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea',
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                ],
                toolbar1: 'undo redo | insert | styleselect | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print preview',
            });

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

            $('#tags').select2({
                tags: true,
                tokenSeparators: [","],
                createTag: function (newTag) {
                    if (newTag.term) {
                        return {
                            id: '{{ \App\Models\Tag::NEW_KEY }}' + newTag.term,
                            text: newTag.term
                        }
                    }
                },
                ajax: {
                    url: "/admin/tags/ajax-form-data",
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