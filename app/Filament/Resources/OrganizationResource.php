<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages;
use App\Models\Organization;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Ecosistem';

    protected static ?string $modelLabel = 'Organizație';

    protected static ?string $pluralModelLabel = 'Organizații';

    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                Forms\Components\Select::make('type')->options(Organization::TYPES)->required(),
                Forms\Components\TextInput::make('website')->url()->prefixIcon('heroicon-o-globe-alt'),
                Forms\Components\TextInput::make('email')->email(),
                Forms\Components\TextInput::make('phone'),
                Forms\Components\TextInput::make('city'),
                Forms\Components\TextInput::make('county'),
                Forms\Components\TextInput::make('country')->default('Romania'),
                Forms\Components\Toggle::make('active')->default(true),
            ]),
            Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
            Forms\Components\FileUpload::make('logo')->image()->directory('logos'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('logo')->label('')->height(40),
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('type')->badge()
                ->formatStateUsing(fn (string $state): string => Organization::TYPES[$state] ?? $state),
            Tables\Columns\TextColumn::make('city')->sortable(),
            Tables\Columns\IconColumn::make('active')->boolean(),
        ])->filters([
            Tables\Filters\SelectFilter::make('type')->options(Organization::TYPES),
            Tables\Filters\TernaryFilter::make('active'),
        ])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
