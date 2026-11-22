<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsArticleResource\Pages\CreateNewsArticle;
use App\Filament\Resources\NewsArticleResource\Pages\EditNewsArticle;
use App\Filament\Resources\NewsArticleResource\Pages\ListNewsArticles;
use App\Models\NewsArticle;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class NewsArticleResource extends Resource
{
    protected static ?string $model = NewsArticle::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static string|\UnitEnum|null $navigationGroup = 'Conținut';

    protected static ?string $modelLabel = 'Articol';

    protected static ?string $pluralModelLabel = 'Noutăți';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required()->live(onBlur: true)
                ->afterStateUpdated(fn ($s, $set) => $set('slug', Str::slug($s))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            FileUpload::make('featured_image')->image()->directory('news'),
            TextInput::make('author'),
            TextInput::make('category'),
            Textarea::make('excerpt')->rows(2)->columnSpanFull(),
            Textarea::make('content')->required()->rows(10)->columnSpanFull(),
            DateTimePicker::make('published_at')->default(now()),
            Toggle::make('featured'),
            Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('featured_image')->height(40),
            TextColumn::make('title')->searchable()->sortable()->limit(50),
            TextColumn::make('category')->badge(),
            TextColumn::make('published_at')->dateTime()->sortable(),
            IconColumn::make('featured')->boolean(),
            IconColumn::make('active')->boolean(),
        ])->defaultSort('published_at', 'desc')
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNewsArticles::route('/'),
            'create' => CreateNewsArticle::route('/create'),
            'edit' => EditNewsArticle::route('/{record}/edit'),
        ];
    }
}
