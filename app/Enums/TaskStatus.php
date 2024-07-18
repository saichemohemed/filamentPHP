<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in-progress';
    case COMPLETED = 'completed';


    public static function options(): array
    {
        return [
            self::PENDING->value => 'Pending',
            self::IN_PROGRESS->value => 'In Progress',
            self::COMPLETED->value => 'Completed',
        ];
    }

}
