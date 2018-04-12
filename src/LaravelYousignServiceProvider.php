<?php namespace QuentinBontemps\LaravelYousign;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use QuentinBontemps\LaravelYousign\Services\LaravelYousign;

class LaravelYousignServiceProvider extends ServiceProvider
{

    private $_root = __DIR__ . '/../';

    public function boot()
    {

    }

    public function register()
    {
        /**
         * Provide configuration file
         */
        $this->mergeConfigFrom(
            $this->_root . 'config/yousign.php', 'laravel-yousign'
        );
        if (App::runningInConsole())
        {
            /**
             * Enable publish configuration file
             */
            $this->publishes([
                "{$this->_root}/config/yousign.php" => config_path('laravel-yousign.php'),
            ], 'laravel_yousign_config');
        }


        $this->app->bind('laravel.yousign', function ($app) {
            return new LaravelYousign();
        });
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'laravel.yousign',
        ];
    }
}