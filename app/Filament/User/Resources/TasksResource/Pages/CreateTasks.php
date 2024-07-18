<?php

namespace App\Filament\User\Resources\TasksResource\Pages;

use App\Filament\User\Resources\TasksResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTasks extends CreateRecord
{
    protected static string $resource = TasksResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
