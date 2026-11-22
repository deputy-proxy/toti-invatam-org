<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages\CreateDonation;
use App\Filament\Resources\DonationResource\Pages\EditDonation;
use App\Filament\Resources\DonationResource\Pages\ListDonations;
use App\Models\Donation;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';

    protected static string|\UnitEnum|null $navigationGroup = 'Cereri & Submisii';

    protected static ?string $modelLabel = 'Donație';

    protected static ?string $pluralModelLabel = 'Donații';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('donor_name')->required(),
            TextInput::make('donor_email')->email()->required(),
            TextInput::make('amount')->numeric()->required(),
            TextInput::make('currency')->default('RON'),
            Select::make('type')->options(['individual' => 'Individual', 'company' => 'Companie'])->default('individual'),
            Toggle::make('recurring'),
            Select::make('project_id')->relationship('project', 'title')->searchable(),
            TextInput::make('payment_provider'),
            TextInput::make('payment_reference'),
            Select::make('status')->options([
                'pending' => 'În așteptare', 'completed' => 'Completată', 'failed' => 'Eșuată', 'refunded' => 'Rambursată',
            ])->default('pending'),
            DateTimePicker::make('donated_at'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('donor_name')->searchable(),
            TextColumn::make('amount')->money('RON')->sortable(),
            TextColumn::make('type')->badge(),
            IconColumn::make('recurring')->boolean(),
            TextColumn::make('project.title')->limit(30),
            TextColumn::make('status')->badge()->color(fn ($s) => match ($s) {
                'completed' => 'success','pending' => 'warning','failed' => 'danger','refunded' => 'gray',default => 'gray'
            }),
            TextColumn::make('donated_at')->dateTime()->sortable(),
        ])->defaultSort('donated_at', 'desc')
            ->recordActions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDonations::route('/'),
            'create' => CreateDonation::route('/create'),
            'edit' => EditDonation::route('/{record}/edit'),
        ];
    }
}
