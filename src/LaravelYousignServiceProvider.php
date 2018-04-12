<?php namespace QuentinBontemps\LaravelYousign;

use Illuminate\Support\ServiceProvider;

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

        /**
         * Enable publish configuration file
         */
        $this->publishes([
            "{$this->_root}/config/yousign.php" => config_path('laravel-yousign.php'),
        ], 'laravel_yousign_config');

        $this->app->bind('laravel.yousign', function ($app) {

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