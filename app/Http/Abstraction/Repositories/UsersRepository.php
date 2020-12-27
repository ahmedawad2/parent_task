<?php


namespace App\Http\Abstraction\Repositories;


use App\Http\Abstraction\Classes\ProvidersClass;
use App\Http\Abstraction\Classes\UserDTOClass;
use App\Http\Abstraction\Factories\UsersDTOFactory;
use App\Http\Abstraction\Interfaces\UsersRepositoryInterface;
use Exception;
use pcrov\JsonReader\JsonReader;

class UsersRepository implements UsersRepositoryInterface
{
    private $provider;
    private $reader;
    private $depth;

    public function __construct(JsonReader $reader, ProvidersClass $provider)
    {
        $this->reader = $reader;
        $this->provider = $provider;
        $this->prepareReader();
    }

    private function prepareReader()
    {
        try {
            $this->reader->open($this->provider->getFilePath());
            $this->reader->read($this->provider->getEntryKey());
            $this->depth = $this->reader->depth();
            $this->reader->read();
        } catch (Exception $e) {
            $this->reader = false;
        }
    }

    public function next(): bool
    {
        $hasNext = $this->reader->next() && $this->reader->depth() > $this->depth;
        if (!$hasNext && $this->provider->hasNext()) {
            $this->prepareReader();
            return true;
        }
        return $hasNext;
    }

    public function currentObject(): ?UserDTOClass
    {
        if ($this->reader) {
            if ($this->reader->value()) {
                try {
                    return UsersDTOFactory::create($this->provider->getName(), $this->reader->value());
                } catch (Exception $e) {
                    return null;
                }
            } elseif ($this->provider->hasNext()) {
                $this->prepareReader();
                return $this->currentObject();
            }
        }
        return null;
    }

    public function __destruct()
    {
        if ($this->reader) {
            $this->reader->close();
        }
    }
}
