<?php

namespace App\Filament\User\Resources\ProjectsResource\Pages;

use App\Filament\User\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjects extends EditRecord
{
    protected static string $resource = ProjectsResource::class;

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
