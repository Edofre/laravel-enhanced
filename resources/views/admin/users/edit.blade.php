@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.edit_name', ['name'=> $user->name]) }}</h1>
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary" href="{!! route('admin.users.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('users.users'))]) }}</a>
                            <a class="btn btn-info" href="{!! route('admin.users.show', $user->id) !!}">{{ trans('crud.show_current', ['model'=> strtolower(trans('users.user'))]) }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'patch']) !!}
                        @include('admin.users._fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection