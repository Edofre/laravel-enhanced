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
