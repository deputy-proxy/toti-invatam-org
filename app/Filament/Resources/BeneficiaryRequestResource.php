<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeneficiaryRequestResource\Pages;
use App\Models\BeneficiaryRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BeneficiaryRequestResource extends Resource
{
    protected static ?string $model = BeneficiaryRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-lifebuoy';

    protected static ?string $navigationGroup = 'Cereri & Submisii';

    protected static ?string $modelLabel = 'Cerere sprijin';

    protected static ?string $pluralModelLabel = 'Cereri sprijin';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('status', 'new')->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('requester_name')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\TextInput::make('phone'),
            Forms\Components\TextInput::make('beneficiary_type'),
            Forms\Components\Textarea::make('educational_need')->required()->columnSpanFull(),
            Forms\Components\TextInput::make('target_audience'),
            Forms\Components\TextInput::make('location'),
            Forms\Components\TextInput::make('estimated_beneficiaries')->numeric(),
            Forms\Components\Textarea::make('requested_support')->columnSpanFull(),
            Forms\Components\Select::make('urgency')->options(['low' => 'Scăzută', 'normal' => 'Normală', 'high' => 'Ridicată', 'critical' => 'Critică'])->default('normal'),
            Forms\Components\Select::make('status')->options([
                'new' => 'Nou', 'contacted' => 'Contactat', 'in_progress' => 'În lucru',
                'matched' => 'Potrivit', 'fulfilled' => 'Îndeplinit', 'rejected' => 'Respins',
            ])->default('new'),
            Forms\Components\Textarea::make('admin_notes')->rows(3)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('requester_name')->searchable(),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('beneficiary_type')->badge(),
            Tables\Columns\TextColumn::make('urgency')->badge()->color(fn ($s) => match ($s) {
                'critical' => 'danger','high' => 'warning','normal' => 'primary',default => 'gray'
            }),
            Tables\Columns\TextColumn::make('status')->badge(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])->defaultSort('created_at', 'desc')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeneficiaryRequests::route('/'),
            'create' => Pages\CreateBeneficiaryRequest::route('/create'),
            'edit' => Pages\EditBeneficiaryRequest::route('/{record}/edit'),
        ];
    }
}
