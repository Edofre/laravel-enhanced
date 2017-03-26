@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.edit_name', ['name'=> $tag->name]) }}</h1>
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary btn" href="{!! route('admin.tags.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('tags.tags'))]) }}</a>
                            <a class="btn btn-info btn" href="{!! route('admin.tags.show', $tag->id) !!}">{{ trans('crud.show_current', ['model'=> strtolower(trans('tags.tag'))]) }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($tag, ['route' => ['admin.tags.update', $tag->id], 'method' => 'patch', 'files' => true]) !!}
                        @include('admin.tags._fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection