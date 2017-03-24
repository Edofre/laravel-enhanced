@extends('layouts.app')

@section('page_title')
    {{ $newsItem->title }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1 class="panel-title pull-left">{{ $newsItem->title }}</h1>
                    </div>
                    <div class="panel-body">
                        <strong>{{ $newsItem->created_at->format('j F, Y') }}</strong>
                        <strong>@html($newsItem->intro)</strong>
                        @html($newsItem->content)

                        @if(!$newsItem->tags->isEmpty())
                            <div class="col-md-12">
                                <div class="newsdetail-tags">
                                    <ul class="list-articletags">
                                        @foreach($newsItem->tags as $tag)
                                            <li>{{ link_to(route('front.tag.index', ['tag' => $tag]), '#'.$tag->name) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection