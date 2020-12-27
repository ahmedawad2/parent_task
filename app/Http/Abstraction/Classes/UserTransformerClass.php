<?php


namespace App\Http\Abstraction\Classes;


use App\Http\Abstraction\Interfaces\UserTransformInterface;

class UserTransformerClass implements UserTransformInterface
{
    private $user;

    public function setUser(UserDTOClass $user):UserTransformInterface
    {
        $this->user = $user;
        return $this;
    }

    public function transform(): ?array
    {
        return [
            'id' => $this->user->getId(),
            'email' => $this->user->getEmail(),
            'amount' => $this->user->getAmount(),
            'currency' => $this->user->getCurrency(),
            'status' => $this->user->getStatus(),
            'created_at' => $this->user->getCreatedAt(),
        ];
    }
}
