@extends('admin.layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h1 class="panel-title pull-left">{{ trans('crud.create_model', ['model' => strtolower(trans('users.user'))]) }}</h1>
            <div class="btn-group pull-right">
                <a class="btn btn-primary" href="{!! route('admin.users.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('users.users'))]) }}</a>
            </div>
        </div>
        <div class="panel-body">
            <div class="content">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            {!! Form::open(['route' => 'admin.users.store']) !!}
                            @include('admin.users._fields')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection