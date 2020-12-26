<?php
/**
 * additional provider Z, it's schema is simulated from provider X.
 */

namespace App\Http\Abstraction\Classes;

class UserZClass extends UserDTOClass
{
    protected static $statusAuthorised = 1;
    protected static $statusDeclined = 2;
    protected static $statusRefunded = 3;
    protected static $fromDateFormat = 'Y-m-d';


    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->amount = $this->getFromData('parentAmount');
        $this->currency = $this->getFromData('Currency');
        $this->email = $this->getFromData('parentEmail');
        $this->statusCode = $this->getFromData('statusCode');
        $this->createdAt = $this->getFromData('registerationDate');
        $this->id = $this->getFromData('parentIdentification');
    }
}
