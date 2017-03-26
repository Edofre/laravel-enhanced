@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.edit_name', ['name'=> $newsItem->title]) }}</h1>
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary btn" href="{!! route('admin.newsItems.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('newsItems.news_items'))]) }}</a>
                            <a class="btn btn-info btn" href="{!! route('admin.newsItems.show', $newsItem->id) !!}">{{ trans('crud.show_current', ['model'=> strtolower(trans('newsItems.news_item'))]) }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($newsItem, ['route' => ['admin.newsItems.update', $newsItem->id], 'method' => 'patch', 'files' => true]) !!}
                        @include('admin.newsItems._fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection