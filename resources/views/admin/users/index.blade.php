@extends('admin.layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h1 class="panel-title pull-left">{{ trans('crud.view_all', ['model'=> strtolower(trans('users.users'))]) }}</h1>
            <div class="btn-group pull-right">
                <a class="btn btn-primary" href="{!! route('admin.users.create') !!}">{{ trans('crud.create') }}</a>
            </div>
        </div>
        <div class="panel-body">
            @include('common._search')
            <table class="table table-responsive" id="users-table">
                <thead>
                <th>{{ trans('users.name') }}</th>
                <th>{{ trans('users.email') }}</th>
                <th colspan="3">{{ trans('crud.actions') }}</th>
                </thead>
                <tbody>
                @if(!$users->isEmpty())
                    @foreach($users as $user)
                        <tr>
                            <td>{!! $user->name !!}</td>
                            <td>{!! $user->email !!}</td>
                            <td>
                                {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! route('admin.users.show', [$user->id]) !!}" title="{{ trans('crud.show') }}" class='btn btn-default'><i class="glyphicon glyphicon-eye-open"></i></a>
                                    <a href="{!! route('admin.users.edit', [$user->id]) !!}" title="{{ trans('crud.edit') }}" class='btn btn-default'><i class="glyphicon glyphicon-edit"></i></a>
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'title'=> trans('crud.delete'),'class' => 'btn btn-danger', 'onclick' => "return confirm('".trans('crud.are_you_sure')."')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            {{ trans('crud.no_models_found', ['model'=> strtolower(trans('users.users'))]) }}
                        </td>
                    </tr>
                @endif
                </tbody>
                <tfoot align="right">
                <tr>
                    <td colspan="7">{{ trans('crud.count_models', ['count' => $users->total()]) }}</td>
                </tr>
                </tfoot>
            </table>
            {{ $users->appends(!empty($search) ? ['search'=> $search] : null)->links() }}
        </div>
    </div>
@endsection