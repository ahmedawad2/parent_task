<?php


namespace App\Http\Abstraction\Classes;

class UserYClass extends UserDTOClass
{
    protected static $statusAuthorised = 100;
    protected static $statusDeclined = 200;
    protected static $statusRefunded = 300;
    protected static $fromDateFormat = 'd/m/Y';

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->amount = $this->getFromData('balance');
        $this->currency = $this->getFromData('currency');
        $this->email = $this->getFromData('email');
        $this->statusCode = $this->getFromData('status');
        $this->createdAt = $this->getFromData('created_at');
        $this->id = $this->getFromData('id');
    }
}
