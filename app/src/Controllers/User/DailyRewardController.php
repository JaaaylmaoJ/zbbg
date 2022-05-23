<?php

namespace App\Controllers\User;

use App\Kernel\App;
use App\Services\DailyReward\DailyRewarder;

class DailyRewardController
{
    public function accrue(): mixed
    {
        $userId   = App::$instance->getRequest()->get('userId');
        $rewarder = new DailyRewarder();
        return $rewarder->rewardUser($userId);
    }
}