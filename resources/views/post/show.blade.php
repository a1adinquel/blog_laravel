@extends('layouts.main')
@section('about')
    <div class="container-xl">
        <div class="d-flex justify-content-around">
            <div>
                <a class="btn btn-dark" href="{{route('post.index')}}">Back</a>
            </div>
            <div>
                <a class="btn btn-dark" href="{{route('post.edit',$post->id)}}">Change</a>
            </div>
            <div>
                <form action="{{route('post.delete',$post->id)}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </div>
        </div>
        <div class="info">
            <h1>{{$post->id}}. {{$post->title}}</h1>
            <div class="description">
                <p>{{$post->content}}</p>
            </div>
        </div>
    </div>
@endsection