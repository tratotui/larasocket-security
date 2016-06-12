<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Post;

class PostsIndexComposer
{
    protected $posts;

    public function __construct()
    {
        $this->posts = Post::all();
    }

    public function compose(View $view)
    {
        $view->with('posts', $this->posts);
    }
}