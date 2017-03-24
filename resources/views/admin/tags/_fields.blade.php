<div class="form-group col-sm-6">
    {!! Form::label('name', trans('tags.name')) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
</div>

<div class="btn-group col-sm-12">
    {!! Form::submit(trans('common.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.tags.index') !!}" class="btn btn-default">{{ trans('common.cancel') }}</a>
</div>