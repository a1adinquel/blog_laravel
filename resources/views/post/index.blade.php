@extends('layouts.main')
@section('about')
    <div class="container-xl">
        @foreach ($posts as $post)
        <div class="d-inline-block">
            <div class="card" style="width: 320px;height:320px; overflow:hidden; border-radius:10px; margin:10px;">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                </div>
                <div class="card-bottom m-2">
                    <a href="{{route('post.show', $post->id)}}">
                        Перейти
                     </a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="mt-5">
            {{ $posts->WithQueryString()->links() }}
        </div>
    </div>
@endsection