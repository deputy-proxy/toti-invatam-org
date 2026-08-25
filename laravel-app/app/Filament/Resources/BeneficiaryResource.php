<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeneficiaryResource\Pages;
use App\Models\Beneficiary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BeneficiaryResource extends Resource
{
    protected static ?string $model = Beneficiary::class;
    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Ecosistem';
    protected static ?string $modelLabel = 'Beneficiar';
    protected static ?string $pluralModelLabel = 'Beneficiari';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')->options(Beneficiary::TYPES)->required(),
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('contact_person'),
            Forms\Components\TextInput::make('email')->email(),
            Forms\Components\TextInput::make('phone'),
            Forms\Components\TextInput::make('city'),
            Forms\Components\TextInput::make('county'),
            Forms\Components\TextInput::make('address'),
            Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
            Forms\Components\Textarea::make('needs')->rows(3)->columnSpanFull(),
            Forms\Components\Textarea::make('accessibility_barriers')->rows(2)->columnSpanFull(),
            Forms\Components\Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('type')->badge()->formatStateUsing(fn($s)=>Beneficiary::TYPES[$s] ?? $s),
            Tables\Columns\TextColumn::make('city'),
            Tables\Columns\IconColumn::make('active')->boolean(),
        ])->filters([
            Tables\Filters\SelectFilter::make('type')->options(Beneficiary::TYPES),
        ])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeneficiaries::route('/'),
            'create' => Pages\CreateBeneficiary::route('/create'),
            'edit' => Pages\EditBeneficiary::route('/{record}/edit'),
        ];
    }
}
