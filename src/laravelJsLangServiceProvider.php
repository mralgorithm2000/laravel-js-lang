<?php

namespace Mralgorithm\LaravelJsLang;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Mralgorithm\LaravelJsLang\Components\laravelJsLang;
class laravelJsLangServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LangCommand::class,
            ]);
            $this->publishes([
                __DIR__ . '/public' => public_path('laravel-js-lang/'),
            ],'laravel-js-lang');
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('laravel-js-lang', laravelJsLang::class);
    }
}
