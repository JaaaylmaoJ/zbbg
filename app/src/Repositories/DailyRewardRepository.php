<?php

namespace App\Repositories;

class DailyRewardRepository implements DailyRewardRepositoryInterface
{
    private const DATA = [
        1 => 10,
        2 => 15,
        3 => 20,
        4 => 25,
        5 => 30,
        6 => 50,
        0 => 100,
    ];

    public function getDayReward($daysInARow): int
    {
        $day = $daysInARow < 7 ? $daysInARow : $daysInARow % 7;
        return static::DATA[$day];
    }
}