@extends('layouts.app')

@section('title')
{{ $query }} · 搜索结果 | @parent
@stop

@section('content')
<div class="container">
<div class="panel panel-default list-panel search-results">
  <div class="panel-heading">
    <h4>
      <span style='color:#F00'>{{ $query }} </span>：搜索结果
    </h4>
  </div>

  <div class="panel-body ">

        @if (count($users))
            @foreach ($users as $user_result)
          <div class="result user media">
            <div class="media">
              <div class="avatar media-left">
                <div class="image"><a title="{{ $user_result->name }}" href="{{ route('users.show', $user_result->id) }}">
                    <img class="media-object img-thumbnail avatar avatar-66" src="{{ $user_result->avatar }}" alt="96" height="60" width="60"></a>
                </div>
              </div>
              <div class="media-body user-info" style="padding-top: 7px">
                <div class="info">
                  <a href="{{ route('users.show', $user_result->id) }}">
                      {{ $user_result->name }}
                      @if ($user_result->real_name)
                          （{{ $user_result->real_name }}）
                      @endif
                  </a>

                  @if ($user_result->introduction)
                       | {{ $user_result->introduction }}
                  @endif

                </div>
                <div class="info number">
                  第 {{ $user_result->id }} 位会员
                    ⋅
                  <span title="注册日期">
                      {{ Carbon\Carbon::parse($user_result->created_at)->format('Y-m-d') }}
                  </span>
                    ⋅ <span>{{ count($user_result->topics) }}</span> 个帖子
                    ⋅ <span>{{ $user_result->email }}</span>
                </div>
              </div>
            </div>

          </div>
          <hr>
            @endforeach
        @endif

        @if (count($topics))
        @foreach($topics as $topic)
<div class="result">
<h4 class="title">

    <a href="{{ $topic->link() }}">{{ $topic->title }}</a>

    <small>by</small>

    <a href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->name }}">
        <img class="avatar avatar-small" alt="{{ $topic->user->name }}" src="{{ $topic->user->avatar }}" height="30px" width="30px" />
        <small>{{ $topic->user->name }}</small>
    </a>

</h4>
<div class="info">
  <span class="url">
        <a href="{{ $topic->link() }}">{{ $topic->link() }}</a>
  </span>
  <span class="date" title="Last Updated At">
      {{ Carbon\Carbon::parse($topic->created_at)->format('Y-m-d') }}

      ⋅
      <i class="fa fa-eye"></i> {{ $topic->view_count }}
      ⋅
      <i class="fa fa-comments-o"></i> {{ $topic->reply_count }}

  </span>

</div>
<div class="desc">
    {{ str_limit($topic->body_original, 250) }}
</div>
<hr>
</div>
        @endforeach
        @endif

        @if ((count($topics)+count($users)) == 0)
            <div class="empty-block">未搜索到任何结果~~</div>
        @endif

  </div>

  <div class="panel-footer">
    
  </div>
</div>
</div>
@stop


@section('scripts')

<script type="text/javascript">
    // $(document).ready(function(){
    //     var query = '{{ $query }}';
    //     var results = query.match(/("[^"]+"|[^"\s]+)/g);
    //     results.each(function() {
    //         //取得标签的文本
    //         var t = $(this).text();
 
    //         //定义正则表达式对象  query是关键字   "g"是指全局范围
    //         var a = new RegExp(query,"g")
    //         //对标签文本进行全局替换，包含关键字的位置替换为加红字span对象
    //         t = t.replace(a,("<span style='color:#F00'>" + query + "</span>"));
    //         //将替换完的文本对象赋给此对象中A标签对象的html值中
    //         $(this).find("a").html(t);
    //       });
    // });
</script>
@stop