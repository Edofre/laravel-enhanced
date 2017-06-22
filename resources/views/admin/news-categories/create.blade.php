@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.create_model', ['model' => strtolower(trans('news-categories.news_category'))]) }}</h1>
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary" href="{!! route('admin.news-categories.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('news-categories.news_categories'))]) }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'admin.news-categories.store', 'files' => true]) !!}
                        @include('admin.news-categories._fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
