<?php

namespace App\Filament\User\Resources\TasksResource\Pages;

use App\Filament\User\Resources\TasksResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTasks extends EditRecord
{
    protected static string $resource = TasksResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
