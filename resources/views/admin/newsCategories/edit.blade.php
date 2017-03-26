@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.edit_name', ['name'=> $newsCategory->name]) }}</h1>
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary btn" href="{!! route('admin.newsCategories.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('newsCategories.news_categories'))]) }}</a>
                            <a class="btn btn-info btn" href="{!! route('admin.newsCategories.show', $newsCategory->id) !!}">{{ trans('crud.show_current', ['model'=> strtolower(trans('newsCategories.news_category'))]) }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($newsCategory, ['route' => ['admin.newsCategories.update', $newsCategory->id], 'method' => 'patch', 'files' => true]) !!}
                        @include('admin.newsCategories._fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection