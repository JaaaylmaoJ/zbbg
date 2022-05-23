<?php

namespace App\Kernel;

use PDO;
use App\RequestParser;

class App
{
    public static App $instance;

    private Request $request;
    private PDO $db;

    public function __construct()
    {
        $this->makeDbConnection();
        $this->parseRequest();
    }

    public static function init(): void
    {
        self::$instance = new App();
    }

    public function getDb(): PDO
    {
        return $this->db;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    private function makeDbConnection(): void
    {
        $dsn      = sprintf('mysql:host=%s;port=%s;dbname=%s;', $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_NAME'],);
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $timezone = $_ENV['APP_TIMEZONE'];

        $this->db = new PDO($dsn, $username, $password);
        $this->db->query(<<<SQL
set names utf8;
set time_zone = $timezone;
SQL);
    }

    private function parseRequest(): void
    {
        $parser = new RequestParser();
        $this->request = $parser->getParsedRequest();
    }
}