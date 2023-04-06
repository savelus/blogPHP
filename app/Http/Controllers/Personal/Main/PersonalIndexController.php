<?php

namespace App\Http\Controllers\Personal\Main;

use App\Http\Controllers\Controller;
use App\Models\User;

class PersonalIndexController extends Controller
{
    public function __invoke()
    {
        $userRole = (int)auth()->user()->role == User::ROLE_ADMIN;
        return view('personal.main.index', compact('userRole'));
    }
}
