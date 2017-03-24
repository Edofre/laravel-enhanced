@extends('layouts.app')

@section('page_title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    @if($newsItems->isEmpty() && $videoItems->isEmpty())
                        <div class="panel-heading clearfix">
                            <h1 class="panel-title pull-left">{{ trans('front.no_items_for_tags', ['tag' => $title]) }}</h1>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                {{ link_to(route('home'), trans('front.click_here_to_go_back')) }}
                            </div>
                        </div>
                    @endif

                    @if(!$newsItems->isEmpty())
                        <div class="panel-heading clearfix">
                            <h1 class="panel-title pull-left">{{ trans('front.news_items_tags', ['tag' => $title]) }}</h1>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12 news-list">
                                @foreach($newsItems as $item)
                                    <div class="col-sm-4">
                                        @include('news._item')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
