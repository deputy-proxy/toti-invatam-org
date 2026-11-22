<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonResource\Pages;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Ecosistem';

    protected static ?string $modelLabel = 'Persoană';

    protected static ?string $pluralModelLabel = 'Persoane';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('first_name')->required(),
            Forms\Components\TextInput::make('last_name')->required(),
            Forms\Components\TextInput::make('email')->email(),
            Forms\Components\TextInput::make('phone'),
            Forms\Components\TextInput::make('profession'),
            Forms\Components\Select::make('organization_id')->relationship('organization', 'name')->searchable(),
            Forms\Components\TextInput::make('city'),
            Forms\Components\TextInput::make('county'),
            Forms\Components\Textarea::make('bio')->rows(3)->columnSpanFull(),
            Forms\Components\FileUpload::make('profile_photo')->image()->avatar()->directory('people'),
            Forms\Components\Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('profile_photo')->circular(),
            Tables\Columns\TextColumn::make('full_name')->label('Nume')->searchable(['first_name', 'last_name'])->sortable(['last_name']),
            Tables\Columns\TextColumn::make('profession'),
            Tables\Columns\TextColumn::make('organization.name'),
            Tables\Columns\TextColumn::make('city'),
            Tables\Columns\IconColumn::make('active')->boolean(),
        ])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePerson::route('/create'),
            'edit' => Pages\EditPerson::route('/{record}/edit'),
        ];
    }
}
