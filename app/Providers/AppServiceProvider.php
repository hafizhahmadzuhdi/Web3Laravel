<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ImageService::class, function ($app) {
            $imageService = new ImageService();
            return $imageService;
        });

        $this->app->singleton(BlogService::class, function ($app) {
            $blogService = new BlogService($imageService);
            return $blogService;
        });

        $this->app->singleton(UserService::class, function ($app) {
            $userService = new UserService($imageService);
            return $userService;
        });

        $this->app->singleton(CommentService::class, function ($app) {
            $commentService = new CommentService($commentService);
            return $commentService;
        });
    }
}
