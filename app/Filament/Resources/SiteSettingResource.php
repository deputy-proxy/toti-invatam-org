<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages\CreateSiteSetting;
use App\Filament\Resources\SiteSettingResource\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettingResource\Pages\ListSiteSettings;
use App\Models\SiteSetting;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string|\UnitEnum|null $navigationGroup = 'Setări';

    protected static ?string $modelLabel = 'Setare';

    protected static ?string $pluralModelLabel = 'Setări site';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('key')->required()->unique(ignoreRecord: true),
            TextInput::make('label'),
            Select::make('type')->options([
                'string' => 'Text scurt', 'text' => 'Text lung', 'number' => 'Număr', 'boolean' => 'Boolean', 'json' => 'JSON',
            ])->default('string')->required(),
            TextInput::make('group')->default('general'),
            Textarea::make('value')->rows(4)->columnSpanFull(),
            Textarea::make('description')->rows(2)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('key')->searchable()->sortable(),
            TextColumn::make('group')->badge(),
            TextColumn::make('type')->badge(),
            TextColumn::make('value')->limit(60),
        ])->defaultGroup('group')->defaultSort('group')
            ->recordActions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiteSettings::route('/'),
            'create' => CreateSiteSetting::route('/create'),
            'edit' => EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
