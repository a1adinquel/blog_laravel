<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;


class DeleteController extends BaseController
{
   public function __invoke(Post $post)
   {
        $post->delete();
        return redirect()->route('post.index');
   }
}