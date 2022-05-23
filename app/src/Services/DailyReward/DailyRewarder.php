<?php

namespace App\Services\DailyReward;

use Exception;
use DateTimeImmutable;
use App\Repositories\Dto\UserDto;
use App\Repositories\UserRepository;
use App\Repositories\DailyRewardRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\DailyRewardRepositoryInterface;

class DailyRewarder
{
    private UserRepositoryInterface $userRepository;
    private DailyRewardRepositoryInterface $rewardRepository;

    public function __construct()
    {
        $this->userRepository   = new UserRepository();
        $this->rewardRepository = new DailyRewardRepository();
    }

    /**
     * @throws Exception
     */
    public function rewardUser(int $userId): UserDto
    {
        $user = $this->userRepository->findById($userId);

        if($user->dt == null) {
            /** @noinspection PhpUnnecessaryLocalVariableInspection */
            $user = $this->updateReward($user, 0);
            return $user;
        }

        $lastRewardGainDate = new DateTimeImmutable($user->dt);
        $now                = new DateTimeImmutable();

        $timeLeft = $now->diff($lastRewardGainDate);

        if($timeLeft->days >= 1 && $timeLeft->days < 2) {
            $user = $this->updateReward($user);
        } else if($timeLeft->days >= 2) {
            $user = $this->updateReward($user, 0);
        }

        return $user;
    }

    private function updateReward(UserDto $user, int $forcedLastRewardedDay = null): UserDto
    {
        $daysInARow     = ($forcedLastRewardedDay ?? $user->days) + 1;
        $coinsGainToday = $this->rewardRepository->getDayReward($daysInARow);

        $user->coins += $coinsGainToday;
        $user->days  = $daysInARow;
        $user->dt    = (new DateTimeImmutable())->format(DATE_RFC3339);

        /** @noinspection PhpUnnecessaryLocalVariableInspection */
        $user = $this->userRepository->updateOne($user);
        return $user;
    }
}