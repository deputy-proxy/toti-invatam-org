<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectCategoryResource\Pages\CreateProjectCategory;
use App\Filament\Resources\ProjectCategoryResource\Pages\EditProjectCategory;
use App\Filament\Resources\ProjectCategoryResource\Pages\ListProjectCategories;
use App\Models\ProjectCategory;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectCategoryResource extends Resource
{
    protected static ?string $model = ProjectCategory::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static string|\UnitEnum|null $navigationGroup = 'Conținut';

    protected static ?string $modelLabel = 'Categorie proiect';

    protected static ?string $pluralModelLabel = 'Categorii proiecte';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required()->live(onBlur: true)
                ->afterStateUpdated(fn ($s, $set) => $set('slug', Str::slug($s))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            TextInput::make('icon'),
            TextInput::make('color')->default('brand'),
            Textarea::make('description')->rows(2)->columnSpanFull(),
            Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('slug'),
            TextColumn::make('icon'),
            IconColumn::make('active')->boolean(),
        ])->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjectCategories::route('/'),
            'create' => CreateProjectCategory::route('/create'),
            'edit' => EditProjectCategory::route('/{record}/edit'),
        ];
    }
}
