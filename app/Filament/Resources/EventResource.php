<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Conținut';
    protected static ?string $modelLabel = 'Eveniment';
    protected static ?string $pluralModelLabel = 'Evenimente';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required()->live(onBlur:true)
                ->afterStateUpdated(fn($s,$set)=>$set('slug',\Illuminate\Support\Str::slug($s))),
            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord:true),
            Forms\Components\FileUpload::make('featured_image')->image()->directory('events'),
            Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
            Forms\Components\TextInput::make('location'),
            Forms\Components\Toggle::make('online'),
            Forms\Components\TextInput::make('event_url')->url(),
            Forms\Components\DateTimePicker::make('start_at')->required(),
            Forms\Components\DateTimePicker::make('end_at'),
            Forms\Components\TextInput::make('capacity')->numeric(),
            Forms\Components\Toggle::make('registration_required'),
            Forms\Components\Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable()->sortable()->limit(50),
            Tables\Columns\TextColumn::make('start_at')->dateTime()->sortable(),
            Tables\Columns\TextColumn::make('location'),
            Tables\Columns\IconColumn::make('online')->boolean(),
            Tables\Columns\IconColumn::make('active')->boolean(),
        ])->defaultSort('start_at')
          ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
