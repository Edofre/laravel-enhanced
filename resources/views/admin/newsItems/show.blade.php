@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.show_name', ['name' => $newsItem->title]) }}</h1>
                        {!! Form::open(['route' => ['admin.newsItems.destroy', $newsItem->id], 'method' => 'delete']) !!}
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary" href="{!! route('admin.newsItems.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('newsItems.news_items'))]) }}</a>
                            <a class="btn btn-warning" href="{!! route('admin.newsItems.edit', $newsItem->id) !!}">{{ trans('crud.edit_current', ['model'=> strtolower(trans('newsItems.news_item'))]) }}</a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'title'=> trans('crud.delete'),'class' => 'btn btn-danger delete-news-item', 'onclick' => "return confirm('".trans('crud.are_you_sure')."')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <dl class="dl-horizontal">
                                <dt>{!! Form::label('slug', trans('common.slug')) !!}</dt>
                                <dd>
                                    <div class="well well-sm">{{ route('front.news.show', ['item' => $newsItem->slug]) }}</div>
                                </dd>
                            </dl>
                            <div class="col-sm-6">
                                <dl class="dl-horizontal">
                                    <dt>{!! Form::label('id', trans('newsItems.id')) !!}</dt>
                                    <dd>{{ $newsItem->id }}</dd>
                                    <dt>{!! Form::label('is_public', trans('newsItems.is_public')) !!}</dt>
                                    <dd>@boolean($newsItem->is_public)</dd>
                                    <dt>{!! Form::label('title', trans('newsItems.title')) !!}</dt>
                                    <dd>{{ $newsItem->title }}</dd>
                                    <dt>{!! Form::label('news_category_id', trans('newsItems.news_category_id')) !!}</dt>
                                    <dd>{{ !is_null($newsItem->newsCategory) ? $newsItem->newsCategory->name : null }}</dd>
                                    <dt>{!! Form::label('image_url', trans('newsItems.image_url')) !!}</dt>
                                    <dd>@html($newsItem->getImage($newsItem->image_url, $newsItem->name, ['width' => '300px']))</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <dl class="dl-horizontal">
                                    <dt>{!! Form::label('created_at', trans('crud.created_at')) !!}</dt>
                                    <dd>{{ $newsItem->created_at }}</dd>
                                    <dt>{!! Form::label('created_by', trans('crud.created_by')) !!}</dt>
                                    <dd>{{ $newsItem->created_by_link }}</dd>
                                </dl>
                            </div>
                            <div class="col-sm-6">
                                <dl class="dl-horizontal">
                                    <dt>{!! Form::label('updated_at', trans('crud.updated_at')) !!}</dt>
                                    <dd>{{ $newsItem->updated_at }}</dd>
                                    <dt>{!! Form::label('updated_by', trans('crud.updated_by')) !!}</dt>
                                    <dd>{{ $newsItem->updated_by_link }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{!! Form::label('intro', trans('newsItems.intro')) !!}</h1>
                    </div>
                    <div class="panel-body">
                        @html($newsItem->intro)
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{!! Form::label('content', trans('newsItems.content')) !!}</h1>
                    </div>
                    <div class="panel-body">
                        @html($newsItem->content)
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{!! Form::label('tags', trans('newsItems.tags')) !!}</h1>
                        &nbsp;
                        <span class="badge">{{ $newsItem->tags->count() }}</span>
                    </div>
                    <div class="panel-body">
                        <h4>
                            @foreach($newsItem->tags as $tag)
                                <span class="label label-default">{{ $tag->name }}</span>
                            @endforeach
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection