<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('post.data.create', [
            'title' => 'Post Data',
        ]);
    }
}
