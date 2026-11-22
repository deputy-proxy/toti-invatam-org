<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeneficiaryRequestResource\Pages\CreateBeneficiaryRequest;
use App\Filament\Resources\BeneficiaryRequestResource\Pages\EditBeneficiaryRequest;
use App\Filament\Resources\BeneficiaryRequestResource\Pages\ListBeneficiaryRequests;
use App\Models\BeneficiaryRequest;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BeneficiaryRequestResource extends Resource
{
    protected static ?string $model = BeneficiaryRequest::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-lifebuoy';

    protected static string|\UnitEnum|null $navigationGroup = 'Cereri & Submisii';

    protected static ?string $modelLabel = 'Cerere sprijin';

    protected static ?string $pluralModelLabel = 'Cereri sprijin';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('status', 'new')->count() ?: null;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('requester_name')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('phone'),
            TextInput::make('beneficiary_type'),
            Textarea::make('educational_need')->required()->columnSpanFull(),
            TextInput::make('target_audience'),
            TextInput::make('location'),
            TextInput::make('estimated_beneficiaries')->numeric(),
            Textarea::make('requested_support')->columnSpanFull(),
            Select::make('urgency')->options(['low' => 'Scăzută', 'normal' => 'Normală', 'high' => 'Ridicată', 'critical' => 'Critică'])->default('normal'),
            Select::make('status')->options([
                'new' => 'Nou', 'contacted' => 'Contactat', 'in_progress' => 'În lucru',
                'matched' => 'Potrivit', 'fulfilled' => 'Îndeplinit', 'rejected' => 'Respins',
            ])->default('new'),
            Textarea::make('admin_notes')->rows(3)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('requester_name')->searchable(),
            TextColumn::make('email'),
            TextColumn::make('beneficiary_type')->badge(),
            TextColumn::make('urgency')->badge()->color(fn ($s) => match ($s) {
                'critical' => 'danger','high' => 'warning','normal' => 'primary',default => 'gray'
            }),
            TextColumn::make('status')->badge(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->defaultSort('created_at', 'desc')
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBeneficiaryRequests::route('/'),
            'create' => CreateBeneficiaryRequest::route('/create'),
            'edit' => EditBeneficiaryRequest::route('/{record}/edit'),
        ];
    }
}
