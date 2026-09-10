<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResourceResource\Pages;
use App\Models\Resource as ResourceModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Conținut';
    protected static ?string $modelLabel = 'Resursă';
    protected static ?string $pluralModelLabel = 'Resurse';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required()->live(onBlur:true)
                ->afterStateUpdated(fn($s,$set)=>$set('slug',\Illuminate\Support\Str::slug($s))),
            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord:true),
            Forms\Components\Select::make('resource_type')->options([
                'article'=>'Articol','guide'=>'Ghid','worksheet'=>'Fișă','video'=>'Video',
                'presentation'=>'Prezentare','external_resource'=>'Resursă externă','other'=>'Altele',
            ])->required(),
            Forms\Components\TextInput::make('audience'),
            Forms\Components\TextInput::make('category'),
            Forms\Components\TextInput::make('author'),
            Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
            Forms\Components\Textarea::make('content')->rows(6)->columnSpanFull(),
            Forms\Components\FileUpload::make('file_path')->directory('resources')->label('Fișier'),
            Forms\Components\TextInput::make('external_url')->url(),
            Forms\Components\FileUpload::make('featured_image')->image()->directory('resources'),
            Forms\Components\DateTimePicker::make('published_at')->default(now()),
            Forms\Components\Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable()->limit(40),
            Tables\Columns\TextColumn::make('resource_type')->badge(),
            Tables\Columns\TextColumn::make('audience'),
            Tables\Columns\TextColumn::make('published_at')->date()->sortable(),
            Tables\Columns\IconColumn::make('active')->boolean(),
        ])->defaultSort('published_at','desc')
          ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResources::route('/'),
            'create' => Pages\CreateResource::route('/create'),
            'edit' => Pages\EditResource::route('/{record}/edit'),
        ];
    }
}
