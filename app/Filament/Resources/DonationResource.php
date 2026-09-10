<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Cereri & Submisii';
    protected static ?string $modelLabel = 'Donație';
    protected static ?string $pluralModelLabel = 'Donații';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('donor_name')->required(),
            Forms\Components\TextInput::make('donor_email')->email()->required(),
            Forms\Components\TextInput::make('amount')->numeric()->required(),
            Forms\Components\TextInput::make('currency')->default('RON'),
            Forms\Components\Select::make('type')->options(['individual'=>'Individual','company'=>'Companie'])->default('individual'),
            Forms\Components\Toggle::make('recurring'),
            Forms\Components\Select::make('project_id')->relationship('project','title')->searchable(),
            Forms\Components\TextInput::make('payment_provider'),
            Forms\Components\TextInput::make('payment_reference'),
            Forms\Components\Select::make('status')->options([
                'pending'=>'În așteptare','completed'=>'Completată','failed'=>'Eșuată','refunded'=>'Rambursată',
            ])->default('pending'),
            Forms\Components\DateTimePicker::make('donated_at'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('donor_name')->searchable(),
            Tables\Columns\TextColumn::make('amount')->money('RON')->sortable(),
            Tables\Columns\TextColumn::make('type')->badge(),
            Tables\Columns\IconColumn::make('recurring')->boolean(),
            Tables\Columns\TextColumn::make('project.title')->limit(30),
            Tables\Columns\TextColumn::make('status')->badge()->color(fn($s)=>match($s){
                'completed'=>'success','pending'=>'warning','failed'=>'danger','refunded'=>'gray',default=>'gray'
            }),
            Tables\Columns\TextColumn::make('donated_at')->dateTime()->sortable(),
        ])->defaultSort('donated_at','desc')
          ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }
}
