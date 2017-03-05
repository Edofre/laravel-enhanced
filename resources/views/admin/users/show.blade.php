@extends('admin.layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h1 class="panel-title pull-left">{{ trans('crud.show_name', ['name' => $user->name]) }}</h1>
            {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}
            <div class="btn-group pull-right">
                <a class="btn btn-primary" href="{!! route('admin.users.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('users.users'))]) }}</a>
                <a class="btn btn-warning" href="{!! route('admin.users.edit', $user->id) !!}">{{ trans('crud.edit_current', ['model'=> strtolower(trans('users.user'))]) }}</a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'title'> trans('crud.delete'),'class' => 'btn btn-danger', 'onclick' => "return confirm('".trans('crud.are_you_sure')."')"]) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <dl class="dl-horizontal">
                        <dt>{!! Form::label('id', trans('users.id')) !!}</dt>
                        <dd>{{ $user->id }}</dd>
                        <dt>{!! Form::label('name', trans('users.name')) !!}</dt>
                        <dd>{{ $user->name }}</dd>
                        <dt>{!! Form::label('email', trans('users.email')) !!}</dt>
                        <dd>{{ Html::mailto($user->email ) }}</dd>
                    </dl>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <dl class="dl-horizontal">
                        <dt>{!! Form::label('created_at', trans('crud.created_at')) !!}</dt>
                        <dd>{{ $user->created_at }}</dd>
                    </dl>
                </div>
                <div class="col-sm-6">
                    <dl class="dl-horizontal">
                        <dt>{!! Form::label('updated_at', trans('crud.updated_at')) !!}</dt>
                        <dd>{{ $user->updated_at }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection