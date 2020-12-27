<?php


namespace App\Http\Abstraction\Classes;


class ProvidersClass
{
    private $current;
    private $providers;

    public function __construct(string $provider = null)
    {
        $this->setCurrent($provider);
    }

    private function setCurrent(string $provider = null)
    {
        if (isset($provider)) {
            if ($this->valid($provider)) {
                $this->current = $provider;
            }
        } else {
            $this->setAll();
            $this->setNext();
        }
    }

    private function setNext()
    {
        $this->setCurrent(array_shift($this->providers));
    }

    private function setAll()
    {
        $this->providers = array_keys(config('data_providers.providers'));
    }

    private function valid(string $provider = null): bool
    {
        return in_array($provider, array_keys(config('data_providers.providers')));
    }

    public function hasNext(): bool
    {
        if (!empty($this->providers)) {
            $this->setNext();
            return true;
        }
        return false;
    }

    public function getClass(): ?string
    {
        return $this->current ?
            config('data_providers.providers.' . $this->current . '.class') : null;
    }

    public function getFilePath(): string
    {
        return $this->current ?
            env('PROVIDERS_PATH', 'jsons/')
            . config('data_providers.providers.' . $this->current . '.file_name')
            . '.json'
            : '';
    }

    public function getEntryKey(): ?string
    {
        return $this->current ?
            config('data_providers.providers.' . $this->current . '.entry_key') : null;
    }

    public function getName(): ?string
    {
        return $this->current;
    }
}
