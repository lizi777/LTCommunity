@if (count($topics))

<ul class="list-group">
    @foreach ($topics as $topic)
        <li class="list-group-item">
            <a href="{{ route('topics.show', $topic->id) }}">
                {{ $topic->title }}
            </a>
            <span class="meta pull-right">
                {{ $topic->reply_count }} 回复
                <span> ⋅ </span>
                {{ $topic->created_at->diffForHumans() }}
            </span>
        </li>
    @endforeach
</ul>

@else
    <div class="alert alert-info" style="margin-top: 10px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        暂时还没有帖子哦~_~
    </div>
@endif

{{-- 分页 --}}
{!! $topics->render() !!}