<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

// Поиск определённого поста (  $posts = Post::find(1);  )

// Выбор всех постов (  $posts = Post::all();  )

// Выбор колонки с значением (  $posts = Post::where('is_published', 1)->get();  )

// Выбор колонки с значением, первый попавшийся (  $posts = Post::where('is_published', 1)->first();  ) 
// но нужно убрать 
// foreach ($posts as $post) {
//     dump ($post->title);
// }
// И заменить его на:
// dump ($posts->title);

    public function create() 
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories','tags'));
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required|string',  
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);

        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }

    public function show(Post $post){
        return view('post.show', compact('post'));
    }

    public function edit(Post $post) {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post','categories','tags'));
    }

    public function update(Post $post) {
        $data = request()->validate([
            'title' => 'string',  
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post) {
        $post->delete();
        return redirect()->route('post.index');

    }

    // public function delete() {
    //     $posts = Post::withTrashed()->find(6);
    //     $posts->restore();
    //     dd('deleted');
    // }

    // Чтобы восстановить 
    // $posts = Post::withTrashed()->find(6);
    // $posts->restore();
    // dd('deleted');

    // firstOrCreate
    // updateOrCreate

    public function firstOrCreate() {
        $anotherPost = [
            'title' => 'title of post from VSCODE',
            'content' => 'some c',
            'image' => 'some aaaimageblabla.jpg',
            'likes' => 21,
            'is_published' => 1,
        ];

        $posts = Post::firstOrCreate([
            'title' => 'title of post from', // Если нашел этот атрибут, то выполняет это действие "first"
        ],[
            'title' => 'title of post from', // Если не нашёл то, создает атрибуты
            'content' => 'some c',
            'image' => 'some aaaimageblabla.jpg',
            'likes' => 21,
            'is_published' => 1,
        ]);

        dump($posts->content);
        dd('finished');
    }

    public function updateOrCreate() {
        $anotherPost = [
            'title' => 'updateorcreate title of post from VSCODE',
            'content' => 'updateorcreate some c321321312',
            'image' => 'updateorcreate some aaaimageblabla.jpg3123',
            'likes' => 21,
            'is_published' => 1,
        ];

        $posts = Post::updateOrCreate([
            'title' => 'title of post not from',
        ],[
            'title' => 'title of post not from',
            'content' => 'its not updated c',
            'image' => 'updated aaaimageblabla.jpg',
            'likes' => 212,
            'is_published' => 0,
        ]);

        dump($posts->content);
        dd('finished updated');
    }
}