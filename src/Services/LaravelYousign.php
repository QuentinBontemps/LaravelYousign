<?php namespace QuentinBontemps\LaravelYousign\Services;


use Yousign\Authentication;
use Yousign\ClientFactory;
use Yousign\Environment;

class LaravelYousign
{

    public function client()
    {
        $environment = config('laravel-yousign.environment');
        $api_key = config('laravel-yousign.api_key');
        $login = config('laravel-yousign.login');
        $password = config('laravel-yousign.password');
        $is_encrypted = config('laravel-yousign.is_encrypted_password');

        if ( ! $is_encrypted)
        {
            $password = Authentication::buildHashedPassword($password);
        }

        $authentication = new Authentication($api_key, $login, $password);

        $factory = new ClientFactory(new Environment($environment), $authentication);

        return $factory->createClient();
    }
}