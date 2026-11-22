<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipInquiryResource\Pages;
use App\Models\PartnershipInquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnershipInquiryResource extends Resource
{
    protected static ?string $model = PartnershipInquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Cereri & Submisii';

    protected static ?string $modelLabel = 'Cerere parteneriat';

    protected static ?string $pluralModelLabel = 'Cereri parteneriat';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('status', 'new')->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('organisation_name')->required(),
            Forms\Components\TextInput::make('contact_name')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\TextInput::make('phone'),
            Forms\Components\TextInput::make('website')->url(),
            Forms\Components\TextInput::make('organisation_type'),
            Forms\Components\TextInput::make('partnership_type'),
            Forms\Components\Textarea::make('message')->required()->columnSpanFull(),
            Forms\Components\Select::make('status')->options([
                'new' => 'Nou', 'contacted' => 'Contactat', 'negotiating' => 'În discuție',
                'accepted' => 'Acceptat', 'rejected' => 'Respins', 'completed' => 'Finalizat',
            ])->required(),
            Forms\Components\Textarea::make('admin_notes')->rows(3)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('organisation_name')->searchable(),
            Tables\Columns\TextColumn::make('contact_name')->searchable(),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('status')->badge(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])->defaultSort('created_at', 'desc')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartnershipInquiries::route('/'),
            'create' => Pages\CreatePartnershipInquiry::route('/create'),
            'edit' => Pages\EditPartnershipInquiry::route('/{record}/edit'),
        ];
    }
}
