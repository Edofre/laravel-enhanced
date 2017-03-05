<div class="pull-right">
    {!! Form::open(['method' => 'GET', 'class' => 'form-inline', 'role' => 'search']) !!}
    <div class="input-group">
        {!! Form::text('search', $search, ['class' => 'form-control input', 'placeholder' => trans('common.search...')]) !!}
        <span class="input-group-btn">
            {!! Form::button('<i class="glyphicon glyphicon-search"></i>', ['type'=>'submit','class' => 'btn btn-primary']) !!}
            <a href="{!! url()->current() !!}" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
        </span>
    </div>
    {!! Form::close() !!}
</div>