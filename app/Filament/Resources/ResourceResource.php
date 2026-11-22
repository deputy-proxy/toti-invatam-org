<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResourceResource\Pages\CreateResource;
use App\Filament\Resources\ResourceResource\Pages\EditResource;
use App\Filament\Resources\ResourceResource\Pages\ListResources;
use App\Models\Resource as ResourceModel;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static string|\UnitEnum|null $navigationGroup = 'Conținut';

    protected static ?string $modelLabel = 'Resursă';

    protected static ?string $pluralModelLabel = 'Resurse';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required()->live(onBlur: true)
                ->afterStateUpdated(fn ($s, $set) => $set('slug', Str::slug($s))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Select::make('resource_type')->options([
                'article' => 'Articol', 'guide' => 'Ghid', 'worksheet' => 'Fișă', 'video' => 'Video',
                'presentation' => 'Prezentare', 'external_resource' => 'Resursă externă', 'other' => 'Altele',
            ])->required(),
            TextInput::make('audience'),
            TextInput::make('category'),
            TextInput::make('author'),
            Textarea::make('description')->rows(3)->columnSpanFull(),
            Textarea::make('content')->rows(6)->columnSpanFull(),
            FileUpload::make('file_path')->directory('resources')->label('Fișier'),
            TextInput::make('external_url')->url(),
            FileUpload::make('featured_image')->image()->directory('resources'),
            DateTimePicker::make('published_at')->default(now()),
            Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->limit(40),
            TextColumn::make('resource_type')->badge(),
            TextColumn::make('audience'),
            TextColumn::make('published_at')->date()->sortable(),
            IconColumn::make('active')->boolean(),
        ])->defaultSort('published_at', 'desc')
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResources::route('/'),
            'create' => CreateResource::route('/create'),
            'edit' => EditResource::route('/{record}/edit'),
        ];
    }
}
