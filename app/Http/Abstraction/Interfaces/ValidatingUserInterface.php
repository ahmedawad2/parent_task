<?php


namespace App\Http\Abstraction\Interfaces;


use App\Http\Abstraction\Classes\UserDTOClass;

interface ValidatingUserInterface
{
    public function setUser(UserDTOClass $userDTO): ValidatingUserInterface;

    public function applyStatus($status): ValidatingUserInterface;

    public function applyAmount($min, $max): ValidatingUserInterface;

    public function applyCurrency($currency): ValidatingUserInterface;

    public function isValid(): bool;

}
