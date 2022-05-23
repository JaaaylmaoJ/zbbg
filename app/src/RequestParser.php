<?php

namespace App;

use App\Kernel\Request;
use App\Enums\ApplicationMode;

class RequestParser
{
    private ?ApplicationMode $mode = null;

    public function __construct()
    {
        $this->defineMode();
    }

    /** @noinspection PhpUnnecessaryLocalVariableInspection */
    public function getParsedRequest(): Request
    {
        $params = $this->parseRequest();
        return new Request($params);
    }

    private function defineMode(): void
    {
        $this->mode = match (php_sapi_name()) {
            'cli'    => ApplicationMode::Cli,
            'phttpd' => ApplicationMode::Web,
        };
    }

    private function parseRequest(): array
    {
        return match ($this->mode) {
            ApplicationMode::Cli => $this->parseConsoleArguments(),
            ApplicationMode::Web => $this->parseWebRequest(),
        };
    }

    /** @noinspection PhpUnnecessaryLocalVariableInspection */
    private function parseConsoleArguments(): array
    {
        $params = getopt('', ['userId:']);
        return $params;
    }

    private function parseWebRequest(): array
    {
        return [];
    }
}