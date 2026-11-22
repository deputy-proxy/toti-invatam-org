<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImpactMetricResource\Pages\CreateImpactMetric;
use App\Filament\Resources\ImpactMetricResource\Pages\EditImpactMetric;
use App\Filament\Resources\ImpactMetricResource\Pages\ListImpactMetrics;
use App\Models\ImpactMetric;
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
use Filament\Tables\Table;

class ImpactMetricResource extends Resource
{
    protected static ?string $model = ImpactMetric::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static string|\UnitEnum|null $navigationGroup = 'Conținut';

    protected static ?string $modelLabel = 'Metrică de impact';

    protected static ?string $pluralModelLabel = 'Metrici de impact';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('project_id')->relationship('project', 'title')->searchable()->label('Proiect (opțional)'),
            TextInput::make('title')->required()->helperText('Ex: Beneficiari conectați'),
            TextInput::make('numeric_value')->required()->helperText('Ex: 5.000'),
            TextInput::make('suffix')->maxLength(20)->helperText('Ex: +, %'),
            Textarea::make('description')->rows(2),
            TextInput::make('icon')->helperText('Nume icon Heroicons: users, academic-cap, etc.'),
            TextInput::make('color')->default('brand'),
            TextInput::make('display_order')->numeric()->default(0),
            Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('numeric_value')->weight('bold'),
            TextColumn::make('suffix'),
            TextColumn::make('project.title')->label('Proiect')->default('— Global'),
            IconColumn::make('active')->boolean(),
            TextColumn::make('display_order')->sortable(),
        ])->reorderable('display_order')->defaultSort('display_order')
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListImpactMetrics::route('/'),
            'create' => CreateImpactMetric::route('/create'),
            'edit' => EditImpactMetric::route('/{record}/edit'),
        ];
    }
}
