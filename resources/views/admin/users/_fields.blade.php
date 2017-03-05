<div class="form-group col-sm-6">
    {!! Form::label('name', trans('users.name')) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('email', trans('users.email')) !!}
    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('password', trans('users.password')) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', trans('users.password_confirmation')) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>
<div class="btn-group col-sm-12">
    {!! Form::submit(trans('common.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.users.index') !!}" class="btn btn-default">{{ trans('common.cancel') }}</a>
</div>