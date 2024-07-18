<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\TasksResource\Pages;
use App\Filament\Resources\TasksResource\RelationManagers;
use App\Models\Tasks;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TasksResource extends Resource
{
    protected static ?string $model = Tasks::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->columnSpan('full'),

                Forms\Components\Textarea::make('description')
                ->required()
                ->maxLength(65535)
                ->columnSpan('full'),

                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options(TaskStatus::options())
                    ->required(),
                ]);
                
    }

    public static function table(Table $table): Table
    {
        return $table
           ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('project.name')
                    ->label('Project'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(TaskStatus::class),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    // All tasks associated with the logged-in user.

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('project', function ($query) {
            $query->where('user_id', auth()->id());
        });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTasks::route('/create'),
            'edit' => Pages\EditTasks::route('/{record}/edit'),
        ];
    }
}
