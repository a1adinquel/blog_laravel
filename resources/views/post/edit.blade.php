@extends('layouts.main')
@section('about')
    <div class="container-xl">
        <form action="{{route('post.update', $post->id)}}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}" placeholder="Title">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control"  name="content" id="content" placeholder="Content">{{$post->content}}</textarea>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="text" class="form-control" name="image" id="image" value="{{$post->image}}" placeholder="Image">
              </div>
              <div class="mb-3">
                <label class="form-label">Category</label>
                <select class="form-control" id="category" name="category_id">
                   @foreach ($categories as $category)
                        <option 
                            {{$category->id === $post->category->id ? 'selected' : ''}}
                            value="{{$category->id}}">{{$category->title}}
                        </option>
                   @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Tags</label>
                <select class="form-control" multiple aria-label="multiple select example" id="tags" name="tags[]">
                    @foreach ($tags as $tag)
                        <option 
                        @foreach ($post->tags as $postTag)
                          {{$tag->id === $postTag->id ? 'selected' : ''}}
                        @endforeach
                          value="{{$tag->id}}">{{$tag->title}}
                        </option>
                    @endforeach
                  </select>
              </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
    </div>
@endsection