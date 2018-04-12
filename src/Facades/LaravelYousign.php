<?php namespace QuentinBontemps\LaravelYousign\Facades;


use Illuminate\Support\Facades\Facade;

class LaravelYousign extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \QuentinBontemps\LaravelYousign\Services\LaravelYousign::class;
    }
}