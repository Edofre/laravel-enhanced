@extends('layouts.app')

@section('page_title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        @include('news._filter')
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ $title }}</h1>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12 news-list">
                            @if($newsItems->isEmpty())
                                <div class="alert alert-danger" role="alert">
                                    {{ trans('front.no_items_found') }}
                                </div>
                            @endif
                            @foreach($newsItems as $item)
                                <div class="col-sm-4">
                                    @include('news._item')
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-12">
                            {{ $newsItems->appends(!empty($search) ? ['search'=> $search] : null)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection