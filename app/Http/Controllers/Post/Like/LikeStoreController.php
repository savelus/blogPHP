<?php

namespace App\Http\Controllers\Post\Like;

use App\Http\Controllers\Controller;
use App\Models\Post;

class LikeStoreController extends Controller
{
    public function __invoke(Post $post)
    {

        auth()->user()->likedPosts()->toggle($post->id);

        return redirect()->back();
    }
}
