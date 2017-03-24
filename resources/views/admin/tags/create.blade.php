@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.create_model', ['model' => strtolower(trans('tags.tag'))]) }}</h1>
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary" href="{!! route('admin.tags.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('tags.tag'))]) }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'admin.tags.store', 'files' => true]) !!}
                        @include('admin.tags._fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
