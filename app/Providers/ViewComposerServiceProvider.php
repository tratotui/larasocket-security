<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Using class based composers...
        view()->composer(
            'posts.index', 'App\ViewComposers\PostsIndexComposer'
        );
    }

    public function register()
    {
    	/*
    	 * ...
    	 */
    }

}