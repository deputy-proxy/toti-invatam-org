<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages\CreateOrganization;
use App\Filament\Resources\OrganizationResource\Pages\EditOrganization;
use App\Filament\Resources\OrganizationResource\Pages\ListOrganizations;
use App\Models\Organization;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static string|\UnitEnum|null $navigationGroup = 'Ecosistem';

    protected static ?string $modelLabel = 'Organizație';

    protected static ?string $pluralModelLabel = 'Organizații';

    protected static ?int $navigationSort = 20;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                Select::make('type')->options(Organization::TYPES)->required(),
                TextInput::make('website')->url()->prefixIcon('heroicon-o-globe-alt'),
                TextInput::make('email')->email(),
                TextInput::make('phone'),
                TextInput::make('city'),
                TextInput::make('county'),
                TextInput::make('country')->default('Romania'),
                Toggle::make('active')->default(true),
            ]),
            Textarea::make('description')->rows(3)->columnSpanFull(),
            FileUpload::make('logo')->image()->directory('logos'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('logo')->label('')->height(40),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('type')->badge()
                ->formatStateUsing(fn (string $state): string => Organization::TYPES[$state] ?? $state),
            TextColumn::make('city')->sortable(),
            IconColumn::make('active')->boolean(),
        ])->filters([
            SelectFilter::make('type')->options(Organization::TYPES),
            TernaryFilter::make('active'),
        ])->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrganizations::route('/'),
            'create' => CreateOrganization::route('/create'),
            'edit' => EditOrganization::route('/{record}/edit'),
        ];
    }
}
