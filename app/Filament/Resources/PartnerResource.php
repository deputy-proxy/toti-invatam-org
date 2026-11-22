<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages\CreatePartner;
use App\Filament\Resources\PartnerResource\Pages\EditPartner;
use App\Filament\Resources\PartnerResource\Pages\ListPartners;
use App\Models\Partner;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
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

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static string|\UnitEnum|null $navigationGroup = 'Ecosistem';

    protected static ?string $modelLabel = 'Partener';

    protected static ?string $pluralModelLabel = 'Parteneri';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('organization_id')->relationship('organization', 'name')->searchable()->required(),
            TextInput::make('partner_type')->default('strategic'),
            TextInput::make('contribution_type'),
            DatePicker::make('start_date'),
            Textarea::make('partnership_description')->rows(3)->columnSpanFull(),
            Toggle::make('featured')->default(false),
            Toggle::make('active')->default(true),
            TextInput::make('display_order')->numeric()->default(0),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('organization.logo')->label('')->height(36),
            TextColumn::make('organization.name')->searchable()->sortable(),
            TextColumn::make('partner_type')->badge(),
            IconColumn::make('featured')->boolean(),
            IconColumn::make('active')->boolean(),
            TextColumn::make('display_order')->sortable(),
        ])->reorderable('display_order')->defaultSort('display_order')
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPartners::route('/'),
            'create' => CreatePartner::route('/create'),
            'edit' => EditPartner::route('/{record}/edit'),
        ];
    }
}
