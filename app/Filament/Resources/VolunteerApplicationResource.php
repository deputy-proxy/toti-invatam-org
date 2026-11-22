<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VolunteerApplicationResource\Pages;
use App\Models\VolunteerApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VolunteerApplicationResource extends Resource
{
    protected static ?string $model = VolunteerApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';

    protected static ?string $navigationGroup = 'Cereri & Submisii';

    protected static ?string $modelLabel = 'Cerere voluntariat';

    protected static ?string $pluralModelLabel = 'Voluntari';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\TextInput::make('phone'),
            Forms\Components\TextInput::make('profession'),
            Forms\Components\Textarea::make('skills')->rows(2)->columnSpanFull(),
            Forms\Components\Textarea::make('motivation')->required()->rows(3)->columnSpanFull(),
            Forms\Components\TextInput::make('availability'),
            Forms\Components\Select::make('status')->options(VolunteerApplication::STATUSES)->required(),
            Forms\Components\Textarea::make('admin_notes')->rows(3)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('profession'),
            Tables\Columns\TextColumn::make('status')->badge()->color(fn ($s) => match ($s) {
                'approved' => 'success','rejected' => 'danger','active' => 'success','pending' => 'warning',default => 'gray'
            }),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('status')->options(VolunteerApplication::STATUSES),
        ])->defaultSort('created_at', 'desc')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVolunteerApplications::route('/'),
            'create' => Pages\CreateVolunteerApplication::route('/create'),
            'edit' => Pages\EditVolunteerApplication::route('/{record}/edit'),
        ];
    }
}
