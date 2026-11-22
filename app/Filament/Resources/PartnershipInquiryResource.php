<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipInquiryResource\Pages\CreatePartnershipInquiry;
use App\Filament\Resources\PartnershipInquiryResource\Pages\EditPartnershipInquiry;
use App\Filament\Resources\PartnershipInquiryResource\Pages\ListPartnershipInquiries;
use App\Models\PartnershipInquiry;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PartnershipInquiryResource extends Resource
{
    protected static ?string $model = PartnershipInquiry::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';

    protected static string|\UnitEnum|null $navigationGroup = 'Cereri & Submisii';

    protected static ?string $modelLabel = 'Cerere parteneriat';

    protected static ?string $pluralModelLabel = 'Cereri parteneriat';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('status', 'new')->count() ?: null;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('organisation_name')->required(),
            TextInput::make('contact_name')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('phone'),
            TextInput::make('website')->url(),
            TextInput::make('organisation_type'),
            TextInput::make('partnership_type'),
            Textarea::make('message')->required()->columnSpanFull(),
            Select::make('status')->options([
                'new' => 'Nou', 'contacted' => 'Contactat', 'negotiating' => 'În discuție',
                'accepted' => 'Acceptat', 'rejected' => 'Respins', 'completed' => 'Finalizat',
            ])->required(),
            Textarea::make('admin_notes')->rows(3)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('organisation_name')->searchable(),
            TextColumn::make('contact_name')->searchable(),
            TextColumn::make('email'),
            TextColumn::make('status')->badge(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->defaultSort('created_at', 'desc')
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPartnershipInquiries::route('/'),
            'create' => CreatePartnershipInquiry::route('/create'),
            'edit' => EditPartnershipInquiry::route('/{record}/edit'),
        ];
    }
}
