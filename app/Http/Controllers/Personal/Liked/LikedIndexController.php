<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;

class LikedIndexController extends Controller
{
    public function __invoke()
    {
        $posts = auth()->user()->likedPosts;

        return view('personal.liked.index', compact('posts'));
    }
}
