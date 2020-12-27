<?php


namespace App\Http\Abstraction\Classes;


use Carbon\Carbon;

abstract class UserDTOClass
{
    const STATUS_AUTHORISED = 'authorised';
    const STATUS_DECLINED = 'decline';
    const STATUS_REFUNDED = 'refunded';
    const STATUS_UNKNOWN = 'unknown';
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
                return self::STATUS_AUTHORISED;
            case static::$statusDeclined:
                return self::STATUS_DECLINED;
            case static::$statusRefunded:
                return self::STATUS_REFUNDED;
            default:
                return self::STATUS_UNKNOWN;
        }
    }

    protected function convertCreatedAt(): ?string
    {
        if (static::$fromDateFormat) {
            try {
                return Carbon::createFromFormat(static::$fromDateFormat, $this->createdAt)->format(self::TO_DATE_FORMAT);
            } catch (\Exception $e) {

            }
        }
        return $this->createdAt;
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
