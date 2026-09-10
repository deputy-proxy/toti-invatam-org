<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsArticleResource\Pages;
use App\Models\NewsArticle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsArticleResource extends Resource
{
    protected static ?string $model = NewsArticle::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Conținut';
    protected static ?string $modelLabel = 'Articol';
    protected static ?string $pluralModelLabel = 'Noutăți';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required()->live(onBlur:true)
                ->afterStateUpdated(fn($s,$set)=>$set('slug',\Illuminate\Support\Str::slug($s))),
            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord:true),
            Forms\Components\FileUpload::make('featured_image')->image()->directory('news'),
            Forms\Components\TextInput::make('author'),
            Forms\Components\TextInput::make('category'),
            Forms\Components\Textarea::make('excerpt')->rows(2)->columnSpanFull(),
            Forms\Components\Textarea::make('content')->required()->rows(10)->columnSpanFull(),
            Forms\Components\DateTimePicker::make('published_at')->default(now()),
            Forms\Components\Toggle::make('featured'),
            Forms\Components\Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('featured_image')->height(40),
            Tables\Columns\TextColumn::make('title')->searchable()->sortable()->limit(50),
            Tables\Columns\TextColumn::make('category')->badge(),
            Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
            Tables\Columns\IconColumn::make('featured')->boolean(),
            Tables\Columns\IconColumn::make('active')->boolean(),
        ])->defaultSort('published_at','desc')
          ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsArticles::route('/'),
            'create' => Pages\CreateNewsArticle::route('/create'),
            'edit' => Pages\EditNewsArticle::route('/{record}/edit'),
        ];
    }
}
