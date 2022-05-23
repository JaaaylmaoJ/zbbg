<?php

use App\Kernel\App;
use App\Controllers\User\DailyRewardController;

require_once __DIR__ . '/../config/bootstrap.php';

App::init();

$controller = new DailyRewardController();
$result     = $controller->accrue();

echo $result . PHP_EOL;