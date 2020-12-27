<?php


namespace App\Http\Abstraction\Factories;


use App\Http\Abstraction\Classes\UserDTOClass;

class UsersDTOFactory
{
    public static function create(string $provider, array $data): UserDTOClass
    {
        if (in_array($provider, array_keys(config('data_providers.providers')))) {
            $class = config('data_providers.providers')[$provider]['class'];
            return new $class($data);
        }
        throw new \Exception('unknown provider');
    }
}
