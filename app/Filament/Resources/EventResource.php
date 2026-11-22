<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages\CreateEvent;
use App\Filament\Resources\EventResource\Pages\EditEvent;
use App\Filament\Resources\EventResource\Pages\ListEvents;
use App\Models\Event;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static string|\UnitEnum|null $navigationGroup = 'Conținut';

    protected static ?string $modelLabel = 'Eveniment';

    protected static ?string $pluralModelLabel = 'Evenimente';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required()->live(onBlur: true)
                ->afterStateUpdated(fn ($s, $set) => $set('slug', Str::slug($s))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            FileUpload::make('featured_image')->image()->directory('events'),
            Textarea::make('description')->rows(3)->columnSpanFull(),
            TextInput::make('location'),
            Toggle::make('online'),
            TextInput::make('event_url')->url(),
            DateTimePicker::make('start_at')->required(),
            DateTimePicker::make('end_at'),
            TextInput::make('capacity')->numeric(),
            Toggle::make('registration_required'),
            Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->sortable()->limit(50),
            TextColumn::make('start_at')->dateTime()->sortable(),
            TextColumn::make('location'),
            IconColumn::make('online')->boolean(),
            IconColumn::make('active')->boolean(),
        ])->defaultSort('start_at')
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvents::route('/'),
            'create' => CreateEvent::route('/create'),
            'edit' => EditEvent::route('/{record}/edit'),
        ];
    }
}
