<?php

namespace App\Kernel;

class Request
{
    public function __construct(private array $params) {}

    public function get(string $name): mixed
    {
        return $this->params[$name] ?: null;
    }
}