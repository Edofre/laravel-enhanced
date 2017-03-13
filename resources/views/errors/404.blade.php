@extends('layouts.app')

@section('page_title')
    404 - {{ trans('error.not_found') }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">404</div>

                    <div class="panel-body">
                        <h1>{{ trans('error.not_found') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
