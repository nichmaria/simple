<?php

namespace Traits;

trait DinamicPropertiesTrait
{
    public array $data = [];

    public function __set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function __get(string $key): mixed
    {
        return $this->data[$key];
    }

    // not sure if its right
    public function __isset(string $key): bool
    {
        if ($this->data[$key] != null) {
            echo 'exists';
            return true;
        }
        if ($this->data[$key] === null) {
            echo 'does not exist';
            return false;
        }
    }
}
