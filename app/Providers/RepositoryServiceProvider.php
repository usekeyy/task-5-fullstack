<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\CategoryInterface',
            'App\Repositories\CategoryRepository'
        );

        $this->app->bind(
            'App\Interfaces\PostInterface',
            'App\Repositories\PostRepository'
        );

        $this->app->bind(
            'App\Interfaces\AuthInterface',
            'App\Repositories\AuthRepository'
        );

        $this->app->bind(
            'App\Interfaces\WebPostInterface',
            'App\Repositories\WebPostRepository'
        );
    }
}