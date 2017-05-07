@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.view_all', ['model'=> strtolower(trans('newsCategories.news_categories'))]) }}</h1>
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary" href="{!! route('admin.news-categories.create') !!}">{{ trans('crud.create') }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('admin.common._search')
                        <table class="table table-responsive" id="news-category-table">
                            <thead>
                            <th>{{ trans('newsCategories.name') }}</th>
                            <th>{{ trans('newsCategories.description') }}</th>
                            <th>{{ trans('newsCategories.is_public') }}</th>
                            <th colspan="3">{{ trans('crud.actions') }}</th>
                            </thead>
                            <tbody>
                            @if(!$newsCategories->isEmpty())
                                @foreach($newsCategories as $newsCategory)
                                    <tr>
                                        <td>{!! $newsCategory->name !!}</td>
                                        <td>{!! str_limit($newsCategory->description, 20) !!}</td>
                                        <td>@boolean($newsCategory->is_public)</td>
                                        <td>
                                            {!! Form::open(['route' => ['admin.news-categories.destroy', $newsCategory->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                                <a href="{!! route('admin.news-categories.show', [$newsCategory->id]) !!}" title="{{ trans('crud.show') }}" class='btn btn-default'><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <a href="{!! route('admin.news-categories.edit', [$newsCategory->id]) !!}" title="{{ trans('crud.edit') }}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'title'=> trans('crud.delete'),'class' => 'btn btn-danger', 'onclick' => "return confirm('".trans('crud.are_you_sure')."')"]) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        {{ trans('crud.no_models_found', ['model'=> strtolower(trans('newsCategories.news_categories'))]) }}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot align="right">
                            <tr>
                                <td colspan="7">{{ trans('crud.count_models', ['count' => $newsCategories->total()]) }}</td>
                            </tr>
                            </tfoot>
                        </table>
                        {{ $newsCategories->appends(!empty($search) ? ['search'=> $search] : null)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection