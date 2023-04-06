<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;

class TagCreateController extends Controller
{
    public function __invoke()
    {
        return view('admin.tag.create');
    }
}
