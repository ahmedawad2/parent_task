<?php


namespace App\Http\Abstraction\Classes;


use App\Http\Controllers\API\Helpers;
use Carbon\Carbon;

abstract class UserDTOClass
{
    const TO_DATE_FORMAT = 'Y/m/d';

    protected $amount;
    protected $currency;
    protected $email;
    protected $statusCode;
    protected $createdAt;
    protected $id;
    protected static $statusAuthorised;
    protected static $statusDeclined;
    protected static $statusRefunded;
    protected static $fromDateFormat;

    protected $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    protected function convertStatusCode(): string
    {
        switch ($this->statusCode) {
            case static::$statusAuthorised:
                return Helpers::STATUS_AUTHORISED;
            case static::$statusDeclined:
                return Helpers::STATUS_DECLINED;
            case static::$statusRefunded:
                return Helpers::STATUS_REFUNDED;
            default:
                return Helpers::STATUS_UNKNOWN;
        }
    }

    protected function convertCreatedAt(): string
    {
        return static::$fromDateFormat ?
            Carbon::createFromFormat(static::$fromDateFormat, $this->createdAt)->format(self::TO_DATE_FORMAT)
            : $this->createdAt;
    }

    protected function getFromData($key)
    {
        return array_key_exists($key, $this->data) ? $this->data[$key] : null;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->convertStatusCode();
    }

    public function getCreatedAt(): ?string
    {
        return $this->convertCreatedAt();
    }
}