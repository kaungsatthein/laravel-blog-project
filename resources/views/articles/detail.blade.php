@extends("layouts.app")
@section("content")
<div class="container" style="max-width: 800px">

    @if (session("info"))
        <div class="alert alert-info">
            {{session("info")}}
        </div>
    @endif

    <div class="card mb-3 border-primary">
        <div class="card-body">
            <h2 class="h3 card-title">{{ $article->title }}</h2>
            <small class="text-muted">
                <b class="text-success">{{$article->user->name}}</b>,
                <b>Category:</b>
                <span class="text-primary">{{$article->category->name}}</span>,
                <b>Comments:</b>
                <span class="text-primary">{{count($article->comments)}}</span>,
                {{ $article->created_at->diffForHumans() }}
            </small>
            <div style="font-size: 1.2em">{{ $article->body }}</div>
                @auth
                    <div class="mt-2">
                        {{-- delete --}}
                        @can('delete-article', $article)
                            <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-sm btn-outline-danger">Delete</a>
                        @endcan
                        {{-- update --}}
                        @can('update-article', $article)
                            <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        @endcan
                    </div>
                @endauth
        </div>
    </div>
    <ul class="list-group">
        <li class="list-group-item active">Comments({{count($article->comments)}})</li>
        @foreach ($article->comments as $comment)
            <li class="list-group-item">
                <b>{{$comment->user->name}}</b>
                <br>
                @auth
                    @can('delete-comment', $comment)
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    @endcan
                @endauth
                {{$comment->content}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
                <br>
            </li>
        @endforeach
    </ul>
    @auth
    <form action="{{url("/comments/add")}}" method="post" class="mt-2">
        @csrf
        <input type="hidden" name="article_id" value="{{$article->id}}">
        <textarea name="content" class="form-control mb-2"></textarea>
        <button class="btn btn-secondary">Add Comment</button>
    </form>
    @endauth

</div>
@endsection
