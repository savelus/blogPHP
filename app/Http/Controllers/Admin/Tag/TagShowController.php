<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagShowController extends Controller
{
    public function __invoke(Tag $tag)
    {
        //$tag = Tag::all();
        return view('admin.tag.show', compact('tag'));
    }
}
