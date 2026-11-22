<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeneficiaryResource\Pages\CreateBeneficiary;
use App\Filament\Resources\BeneficiaryResource\Pages\EditBeneficiary;
use App\Filament\Resources\BeneficiaryResource\Pages\ListBeneficiaries;
use App\Models\Beneficiary;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BeneficiaryResource extends Resource
{
    protected static ?string $model = Beneficiary::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-heart';

    protected static string|\UnitEnum|null $navigationGroup = 'Ecosistem';

    protected static ?string $modelLabel = 'Beneficiar';

    protected static ?string $pluralModelLabel = 'Beneficiari';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('type')->options(Beneficiary::TYPES)->required(),
            TextInput::make('name')->required(),
            TextInput::make('contact_person'),
            TextInput::make('email')->email(),
            TextInput::make('phone'),
            TextInput::make('city'),
            TextInput::make('county'),
            TextInput::make('address'),
            Textarea::make('description')->rows(3)->columnSpanFull(),
            Textarea::make('needs')->rows(3)->columnSpanFull(),
            Textarea::make('accessibility_barriers')->rows(2)->columnSpanFull(),
            Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('type')->badge()
                ->formatStateUsing(fn (string $state): string => Beneficiary::TYPES[$state] ?? $state),
            TextColumn::make('city'),
            IconColumn::make('active')->boolean(),
        ])->filters([
            SelectFilter::make('type')->options(Beneficiary::TYPES),
        ])->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBeneficiaries::route('/'),
            'create' => CreateBeneficiary::route('/create'),
            'edit' => EditBeneficiary::route('/{record}/edit'),
        ];
    }
}
