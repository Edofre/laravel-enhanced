@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.show_name', ['name' => $newsCategory->name]) }}</h1>
                        {!! Form::open(['route' => ['admin.news-categories.destroy', $newsCategory->id], 'method' => 'delete']) !!}
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary" href="{!! route('admin.news-categories.index') !!}">{{ trans('crud.view_all', ['model'=> strtolower(trans('newsCategories.news_categories'))]) }}</a>
                            <a class="btn btn-warning" href="{!! route('admin.news-categories.edit', $newsCategory->id) !!}">{{ trans('crud.edit_current', ['model'=> strtolower(trans('newsCategories.news_category'))]) }}</a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'title'=> trans('crud.delete'),'class' => 'btn btn-danger delete-news-category', 'onclick' => "return confirm('".trans('crud.are_you_sure')."')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <dl class="dl-horizontal">
                                <dt>{!! Form::label('slug', trans('common.slug')) !!}</dt>
                                <dd>
                                    <div class="well well-sm">
                                        @php
                                            $route = route('front.news.category', ['item' => $newsCategory->slug]);
                                        @endphp
                                        <a href="{{ $route }}" target="_blank">
                                            {{ $route }}
                                        </a>
                                    </div>
                                </dd>
                            </dl>
                            <div class="col-sm-6">
                                <dl class="dl-horizontal">
                                    <dt>{!! Form::label('id', trans('newsCategories.id')) !!}</dt>
                                    <dd>{{ $newsCategory->id }}</dd>
                                    <dt>{!! Form::label('is_public', trans('newsCategories.is_public')) !!}</dt>
                                    <dd>@boolean($newsCategory->is_public)</dd>
                                    <dt>{!! Form::label('name', trans('newsCategories.name')) !!}</dt>
                                    <dd>{{ $newsCategory->name }}</dd>
                                    <dt>{!! Form::label('image_url', trans('newsCategories.image_url')) !!}</dt>
                                    <dd>@html($newsCategory->getImage($newsCategory->image_url, $newsCategory->name, ['class' => 'news-category-image','width' => '300px']))</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <dl class="dl-horizontal">
                                    <dt>{!! Form::label('created_at', trans('crud.created_at')) !!}</dt>
                                    <dd>{{ $newsCategory->created_at }}</dd>
                                    <dt>{!! Form::label('created_by', trans('crud.created_by')) !!}</dt>
                                    <dd>{{ $newsCategory->created_by_link }}</dd>
                                </dl>
                            </div>
                            <div class="col-sm-6">
                                <dl class="dl-horizontal">
                                    <dt>{!! Form::label('updated_at', trans('crud.updated_at')) !!}</dt>
                                    <dd>{{ $newsCategory->updated_at }}</dd>
                                    <dt>{!! Form::label('updated_by', trans('crud.updated_by')) !!}</dt>
                                    <dd>{{ $newsCategory->updated_by_link }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{!! Form::label('description', trans('newsCategories.description')) !!}</h1>
                    </div>
                    <div class="panel-body">
                        @html($newsCategory->description)
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('newsItems.news_items') }}</h1>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive" id="news-item-table">
                            <thead>
                            <th>{{ trans('newsItems.is_public') }}</th>
                            <th>{{ trans('newsItems.title') }}</th>
                            <th>{{ trans('newsItems.intro') }}</th>
                            <th>{{ trans('newsItems.news_category_id') }}</th>
                            <th colspan="3">{{ trans('crud.actions') }}</th>
                            </thead>
                            <tbody>
                            @if(!$newsItems->isEmpty())
                                @foreach($newsItems as $newsItem)
                                    <tr>
                                        <td>@boolean($newsItem->is_public)</td>
                                        <td>{!! $newsItem->title !!}</td>
                                        <td>{!! str_limit($newsItem->intro, 20) !!}</td>
                                        <td>{{ !is_null($newsItem->newsCategory) ? $newsItem->newsCategory->name : null }}</td>
                                        <td>
                                            {!! Form::open(['route' => ['admin.news-items.destroy', $newsItem->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                                <a href="{!! route('admin.news-items.show', [$newsItem->id]) !!}" title="{{ trans('crud.show') }}" class='btn btn-default'><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <a href="{!! route('admin.news-items.edit', [$newsItem->id]) !!}" title="{{ trans('crud.edit') }}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'title'=> trans('crud.delete'),'class' => 'btn btn-danger', 'onclick' => "return confirm('".trans('crud.are_you_sure')."')"]) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        {{ trans('crud.no_models_found', ['model'=> strtolower(trans('newsItems.news_items'))]) }}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot align="right">
                            <tr>
                                <td colspan="7">{{ trans('crud.count_models', ['count' => $newsItems->total()]) }}</td>
                            </tr>
                            </tfoot>
                        </table>
                        @if(!$newsItems->isEmpty())
                            {{ $newsItems->appends(!empty($search) ? ['search'=> $search] : null)->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection