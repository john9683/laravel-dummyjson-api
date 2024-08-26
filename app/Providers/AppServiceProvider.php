<?php

namespace App\Providers;

use App\Services\HttpInterface;
use App\Services\HttpService;
use App\Services\ImageInterface;
use App\Services\ImageService;
use App\Services\LogInterface;
use App\Services\LogService;
use App\Services\ProductInterface;
use App\Services\ProductService;
use App\Services\ReviewInterface;
use App\Services\ReviewService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(HttpInterface::class, function (){
            return new HttpService();
        });

        $this->app->bind(ProductInterface::class, function (){
            return new ProductService();
        });

        $this->app->bind(ImageInterface::class, function (){
            return new ImageService();
        });

        $this->app->bind(ReviewInterface::class, function (){
            return new ReviewService();
        });

        $this->app->bind(LogInterface::class, function (){
            return new LogService();
        });
    }

    /**
     * @return void
     */
    public function boot()
    {
        //
    }
}
