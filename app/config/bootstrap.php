<?php

use Symfony\Component\Dotenv\Dotenv;

define('APP_PATH', dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(APP_PATH . '/.env');

date_default_timezone_set($_ENV['APP_TIMEZONE']);