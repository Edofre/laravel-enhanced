@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ trans('crud.view_all', ['model'=> strtolower(trans('tags.tags'))]) }}</h1>
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary" href="{!! route('admin.tags.create') !!}">{{ trans('crud.create') }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('admin.common._search')
                        <table class="table table-responsive" id="news-category-table">
                            <thead>
                            <th>{{ trans('tags.name') }}</th>
                            <th colspan="3">{{ trans('crud.actions') }}</th>
                            </thead>
                            <tbody>
                            @if(!$tags->isEmpty())
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{!! $tag->name !!}</td>
                                        <td>
                                            {!! Form::open(['route' => ['admin.tags.destroy', $tag->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                                <a href="{!! route('admin.tags.show', [$tag->id]) !!}" title="{{ trans('crud.show') }}" class='btn btn-default'><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <a href="{!! route('admin.tags.edit', [$tag->id]) !!}" title="{{ trans('crud.edit') }}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'title'=> trans('crud.delete'),'class' => 'btn btn-danger', 'onclick' => "return confirm('".trans('crud.are_you_sure')."')"]) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        {{ trans('crud.no_models_found', ['model'=> strtolower(trans('tags.tags'))]) }}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot align="right">
                            <tr>
                                <td colspan="7">{{ trans('crud.count_models', ['count' => $tags->total()]) }}</td>
                            </tr>
                            </tfoot>
                        </table>
                        {{ $tags->appends(!empty($search) ? ['search'=> $search] : null)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection