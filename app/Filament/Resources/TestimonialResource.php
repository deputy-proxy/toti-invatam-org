<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages\CreateTestimonial;
use App\Filament\Resources\TestimonialResource\Pages\EditTestimonial;
use App\Filament\Resources\TestimonialResource\Pages\ListTestimonials;
use App\Models\Testimonial;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';

    protected static string|\UnitEnum|null $navigationGroup = 'Conținut';

    protected static ?string $modelLabel = 'Testimonial';

    protected static ?string $pluralModelLabel = 'Testimoniale';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required()->maxLength(255),
            TextInput::make('role')->maxLength(255),
            TextInput::make('organisation')->maxLength(255),
            Select::make('category')->options(Testimonial::CATEGORIES),
            Textarea::make('quote')->required()->rows(3)->columnSpanFull(),
            FileUpload::make('photo')->image()->avatar()->directory('testimonials'),
            Select::make('project_id')->relationship('project', 'title')->searchable(),
            TextInput::make('display_order')->numeric()->default(0),
            Toggle::make('featured')->default(true),
            Toggle::make('active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('photo')->circular(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('role')->limit(30),
            TextColumn::make('category')->badge(),
            IconColumn::make('featured')->boolean(),
            IconColumn::make('active')->boolean(),
            TextColumn::make('display_order')->sortable(),
        ])->reorderable('display_order')->defaultSort('display_order')
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTestimonials::route('/'),
            'create' => CreateTestimonial::route('/create'),
            'edit' => EditTestimonial::route('/{record}/edit'),
        ];
    }
}
