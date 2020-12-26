<?php


namespace App\Http\Abstraction\Interfaces;


use App\Http\Abstraction\Classes\UserDTOClass;

interface UserTransformInterface
{
    public function setUser(UserDTOClass $user);

    public function transform(): ?array;
}
