<?php

namespace App\Enums;

enum ApplicationMode: string
{
    case Cli = 'cli';
    case Web = 'web';
}