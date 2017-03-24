@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.create_model', ['model' => strtolower(trans('newsCategories.news_category'))]) }}</h1>
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary" href="{!! route('admin.newsCategories.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('newsCategories.news_category'))]) }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'admin.newsCategories.store', 'files' => true]) !!}
                        @include('admin.newsCategories._fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
