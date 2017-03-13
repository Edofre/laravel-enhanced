@extends('layouts.app')

@section('page_title')
    403 - {{ trans('error.forbidden') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">403</div>
                    <div class="panel-body">
                        <h1>{{ trans('error.forbidden') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
