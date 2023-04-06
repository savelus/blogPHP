<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;

class PostIndexController extends BaseController
{
    public function __invoke()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }
}
