<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VolunteerApplicationResource\Pages\CreateVolunteerApplication;
use App\Filament\Resources\VolunteerApplicationResource\Pages\EditVolunteerApplication;
use App\Filament\Resources\VolunteerApplicationResource\Pages\ListVolunteerApplications;
use App\Models\VolunteerApplication;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class VolunteerApplicationResource extends Resource
{
    protected static ?string $model = VolunteerApplication::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-hand-raised';

    protected static string|\UnitEnum|null $navigationGroup = 'Cereri & Submisii';

    protected static ?string $modelLabel = 'Cerere voluntariat';

    protected static ?string $pluralModelLabel = 'Voluntari';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('phone'),
            TextInput::make('profession'),
            Textarea::make('skills')->rows(2)->columnSpanFull(),
            Textarea::make('motivation')->required()->rows(3)->columnSpanFull(),
            TextInput::make('availability'),
            Select::make('status')->options(VolunteerApplication::STATUSES)->required(),
            Textarea::make('admin_notes')->rows(3)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('email')->searchable(),
            TextColumn::make('profession'),
            TextColumn::make('status')->badge()->color(fn ($s) => match ($s) {
                'approved' => 'success','rejected' => 'danger','active' => 'success','pending' => 'warning',default => 'gray'
            }),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->filters([
            SelectFilter::make('status')->options(VolunteerApplication::STATUSES),
        ])->defaultSort('created_at', 'desc')
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVolunteerApplications::route('/'),
            'create' => CreateVolunteerApplication::route('/create'),
            'edit' => EditVolunteerApplication::route('/{record}/edit'),
        ];
    }
}
