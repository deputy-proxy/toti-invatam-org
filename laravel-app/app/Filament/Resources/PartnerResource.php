<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static ?string $navigationIcon = 'heroicon-o-handshake';
    protected static ?string $navigationGroup = 'Ecosistem';
    protected static ?string $modelLabel = 'Partener';
    protected static ?string $pluralModelLabel = 'Parteneri';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('organization_id')->relationship('organization','name')->searchable()->required(),
            Forms\Components\TextInput::make('partner_type')->default('strategic'),
            Forms\Components\TextInput::make('contribution_type'),
            Forms\Components\DatePicker::make('start_date'),
            Forms\Components\Textarea::make('partnership_description')->rows(3)->columnSpanFull(),
            Forms\Components\Toggle::make('featured')->default(false),
            Forms\Components\Toggle::make('active')->default(true),
            Forms\Components\TextInput::make('display_order')->numeric()->default(0),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('organization.logo')->label('')->height(36),
            Tables\Columns\TextColumn::make('organization.name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('partner_type')->badge(),
            Tables\Columns\IconColumn::make('featured')->boolean(),
            Tables\Columns\IconColumn::make('active')->boolean(),
            Tables\Columns\TextColumn::make('display_order')->sortable(),
        ])->reorderable('display_order')->defaultSort('display_order')
          ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
