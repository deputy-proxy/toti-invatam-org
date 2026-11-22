<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonResource\Pages\CreatePerson;
use App\Filament\Resources\PersonResource\Pages\EditPerson;
use App\Filament\Resources\PersonResource\Pages\ListPeople;
use App\Models\Person;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static string|\UnitEnum|null $navigationGroup = 'Ecosistem';

    protected static ?string $modelLabel = 'Persoană';

    protected static ?string $pluralModelLabel = 'Persoane';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('first_name')->required(),
            TextInput::make('last_name')->required(),
            TextInput::make('email')->email(),
            TextInput::make('phone'),
            TextInput::make('profession'),
            Select::make('organization_id')->relationship('organization', 'name')->searchable(),
            TextInput::make('city'),
            TextInput::make('county'),
            Textarea::make('bio')->rows(3)->columnSpanFull(),
            FileUpload::make('profile_photo')->image()->avatar()->directory('people'),
            Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('profile_photo')->circular(),
            TextColumn::make('full_name')->label('Nume')->searchable(['first_name', 'last_name'])->sortable(['last_name']),
            TextColumn::make('profession'),
            TextColumn::make('organization.name'),
            TextColumn::make('city'),
            IconColumn::make('active')->boolean(),
        ])->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPeople::route('/'),
            'create' => CreatePerson::route('/create'),
            'edit' => EditPerson::route('/{record}/edit'),
        ];
    }
}
