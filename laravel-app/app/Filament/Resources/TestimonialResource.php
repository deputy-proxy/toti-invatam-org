<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';
    protected static ?string $navigationGroup = 'Conținut';
    protected static ?string $modelLabel = 'Testimonial';
    protected static ?string $pluralModelLabel = 'Testimoniale';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(255),
            Forms\Components\TextInput::make('role')->maxLength(255),
            Forms\Components\TextInput::make('organisation')->maxLength(255),
            Forms\Components\Select::make('category')->options(Testimonial::CATEGORIES),
            Forms\Components\Textarea::make('quote')->required()->rows(3)->columnSpanFull(),
            Forms\Components\FileUpload::make('photo')->image()->avatar()->directory('testimonials'),
            Forms\Components\Select::make('project_id')->relationship('project','title')->searchable(),
            Forms\Components\TextInput::make('display_order')->numeric()->default(0),
            Forms\Components\Toggle::make('featured')->default(true),
            Forms\Components\Toggle::make('active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('photo')->circular(),
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('role')->limit(30),
            Tables\Columns\TextColumn::make('category')->badge(),
            Tables\Columns\IconColumn::make('featured')->boolean(),
            Tables\Columns\IconColumn::make('active')->boolean(),
            Tables\Columns\TextColumn::make('display_order')->sortable(),
        ])->reorderable('display_order')->defaultSort('display_order')
          ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
