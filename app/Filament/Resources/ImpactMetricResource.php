<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImpactMetricResource\Pages;
use App\Models\ImpactMetric;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ImpactMetricResource extends Resource
{
    protected static ?string $model = ImpactMetric::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static ?string $navigationGroup = 'Conținut';

    protected static ?string $modelLabel = 'Metrică de impact';

    protected static ?string $pluralModelLabel = 'Metrici de impact';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('project_id')->relationship('project', 'title')->searchable()->label('Proiect (opțional)'),
            Forms\Components\TextInput::make('title')->required()->helperText('Ex: Beneficiari conectați'),
            Forms\Components\TextInput::make('numeric_value')->required()->helperText('Ex: 5.000'),
            Forms\Components\TextInput::make('suffix')->maxLength(20)->helperText('Ex: +, %'),
            Forms\Components\Textarea::make('description')->rows(2),
            Forms\Components\TextInput::make('icon')->helperText('Nume icon Heroicons: users, academic-cap, etc.'),
            Forms\Components\TextInput::make('color')->default('brand'),
            Forms\Components\TextInput::make('display_order')->numeric()->default(0),
            Forms\Components\Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('numeric_value')->weight('bold'),
            Tables\Columns\TextColumn::make('suffix'),
            Tables\Columns\TextColumn::make('project.title')->label('Proiect')->default('— Global'),
            Tables\Columns\IconColumn::make('active')->boolean(),
            Tables\Columns\TextColumn::make('display_order')->sortable(),
        ])->reorderable('display_order')->defaultSort('display_order')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImpactMetrics::route('/'),
            'create' => Pages\CreateImpactMetric::route('/create'),
            'edit' => Pages\EditImpactMetric::route('/{record}/edit'),
        ];
    }
}
