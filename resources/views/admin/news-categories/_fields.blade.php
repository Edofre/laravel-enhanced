<div class="form-group col-sm-6">
    {!! Form::label('is_public', trans('newsCategories.is_public')) !!}
    {!! Form::checkbox('is_public', 1, old('is_public'), ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('name', trans('newsCategories.name')) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12">
    {!! Form::label('description', trans('newsCategories.description')) !!}
    {!! Form::textArea('description', old('description'), ['class' => 'form-control']) !!}
</div>
<div class="form-group col-md-6">
    @if(!empty($newsCategory->image_url))
        <div class="rw">
            @html($newsCategory->getImage($newsCategory->image_url, $newsCategory->name, ['width' => '300px']))
            <p>{{ trans('common.uploading_new_file') }}</p>
        </div>
    @endif
    {!! Form::label('upload_file', trans('newsCategories.image_url')) !!}
    {!! Form::file('upload_file', ['class' => 'form-control']) !!}
</div>

<div class="btn-group col-sm-12">
    {!! Form::submit(trans('common.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.news-categories.index') !!}" class="btn btn-default">{{ trans('common.cancel') }}</a>
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
        });
    </script>
@endsection