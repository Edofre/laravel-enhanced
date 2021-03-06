@extends('layouts.app')

@section('page_title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        {{ trans('auth.general.you_are_logged_in') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
