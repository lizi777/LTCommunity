@if (count($replies))

<ul class="list-group">
    @foreach ($replies as $reply)
        <li class="list-group-item">
            <a href="{{ $reply->topic->link(['#reply' . $reply->id]) }}">
                {{ $reply->topic->title }}
            </a>

            <div class="reply-content" style="margin: 6px 0;">
                {!! $reply->content !!}
            </div>

            <div class="meta">
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span> 回复于 {{ $reply->created_at->diffForHumans() }}
            </div>
        </li>
    @endforeach
</ul>

@else
    <div class="alert alert-info" style="margin-top: 10px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        暂时还没有回复哦~_~
    </div>@endif

{{-- 分页 --}}
{!! $replies->appends(Request::except('page'))->render() !!}