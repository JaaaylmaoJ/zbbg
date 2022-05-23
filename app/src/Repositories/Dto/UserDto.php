<?php

namespace App\Repositories\Dto;

use DateTimeInterface;

class UserDto implements \Stringable
{
    public ?int                          $id = null;
    public ?int                          $days = null;
    public DateTimeInterface|string|null $dt = null;
    public ?float                        $coins = null;

    public function __toString(): string
    {
        return json_encode([
            'id'    => $this->id,
            'days'  => $this->days,
            'dt'    => $this->dt,
            'coins' => $this->coins,
        ], JSON_UNESCAPED_UNICODE);
    }
}