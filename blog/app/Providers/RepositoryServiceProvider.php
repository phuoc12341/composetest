<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\CommentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Repository\CommentRepositoryInterface::class, \App\Repository\CommentRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
