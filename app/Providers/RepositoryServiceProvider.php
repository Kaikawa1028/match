<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repository\Contract\ImageFileRepository::class,
            function($app) {
                if(env("APP_ENV") == "testing"){
                    return new \App\Repository\TestImageFileRepository();
                }

                return new \App\Repository\S3ImageFileRepository();
            }
        );
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
