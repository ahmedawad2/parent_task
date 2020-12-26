<?php


namespace App\Http\Abstraction\Repositories;


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
    private $allProviders;

    public function __construct(JsonReader $reader, string $provider = null)
    {
        $this->reader = $reader;
        if (!$provider) {
            $this->setAllProviders();
        }
        $this->setProvider($provider);
    }

    private function setAllProviders()
    {
        if (config('data_providers')) {
            $this->allProviders = array_keys(config('data_providers'));
        }
    }

    private function setProvider(string $provider = null)
    {
        $this->provider = $this->validProvider($provider) ? $provider : $this->getNextProvider();
        $this->prepareReader();
    }

    private function validProvider(string $provider = null): bool
    {
        return config('data_providers') ?
            in_array($provider, array_keys(config('data_providers'))) : false;
    }

    private function prepareReader()
    {
        if ($this->provider) {
            try {
                $this->reader->open(env('PROVIDERS_PATH', 'jsons') . $this->provider . '.json');
                $this->reader->read("users");
                $this->depth = $this->reader->depth();
                $this->reader->read();
            } catch (Exception $e) {
                $this->reader = false;
            }
        }
    }

    private function getNextProvider(): ?string
    {
        return $this->allProviders ? array_shift($this->allProviders) : null;
    }

    public function hasNext(): bool
    {
        if ($this->reader) {
            try {
                $hasNext = $this->reader->next() && $this->reader->depth() > $this->depth;
                if (!$hasNext && $this->allProviders) {
                    $this->setProvider();
                    return true;
                }
                return $hasNext;
            } catch (Exception $e) {

            }
        }
        return false;
    }

    public function currentObject(): ?UserDTOClass
    {
        if ($this->reader && $this->reader->value()) {
            try {
                return UsersDTOFactory::create($this->provider, $this->reader->value());
            } catch (Exception $e) {

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