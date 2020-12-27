<?php


namespace App\Http\Abstraction\Interfaces;

use App\Http\Abstraction\Classes\UserDTOClass;

interface UsersRepositoryInterface
{
    public function currentObject(): ?UserDTOClass;

    public function next(): bool;
}
