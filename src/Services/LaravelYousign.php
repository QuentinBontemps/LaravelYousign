<?php namespace QuentinBontemps\LaravelYousign\Services;


use Yousign\Authentication;
use Yousign\ClientFactory;
use Yousign\Environment;

/**
 * Class LaravelYousign
 * @package QuentinBontemps\LaravelYousign\Services
 */
class LaravelYousign
{

    /**
     * Création d'un client Yousign
     *
     * @param array $options
     * @return \Yousign\Client
     * @throws \Yousign\Exception\EnvironmentException
     */
    public function client($options = [])
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

        /**
         * Si version de démo, on active les traces pour pouvoir débugger plus facilement
         */
        if ($environment == Environment::DEMO)
        {
            if ( ! array_key_exists('trace', $options))
            {
                $options['trace'] = true;
            }
            if ( ! array_key_exists('exceptions', $options))
            {
                $options['exceptions'] = true;
            }
        }

        return $factory->createClient($options);
    }
}