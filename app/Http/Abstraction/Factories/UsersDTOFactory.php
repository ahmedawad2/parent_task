<?php


namespace App\Http\Abstraction\Factories;


use App\Http\Abstraction\Classes\UserDTOClass;
use App\Http\Abstraction\Interfaces\UserDTOInterface;

class UsersDTOFactory
{
    public static function create(string $provider, array $data): UserDTOClass
    {
        if (in_array($provider, array_keys(config('data_providers')))) {
            $class = config('data_providers')[$provider];
            return new $class($data);
        }
        throw new \Exception('unknown provider');
    }
}
