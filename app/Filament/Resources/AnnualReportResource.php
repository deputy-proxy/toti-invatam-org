<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnualReportResource\Pages\CreateAnnualReport;
use App\Filament\Resources\AnnualReportResource\Pages\EditAnnualReport;
use App\Filament\Resources\AnnualReportResource\Pages\ListAnnualReports;
use App\Models\AnnualReport;
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

class AnnualReportResource extends Resource
{
    protected static ?string $model = AnnualReport::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-check';

    protected static string|\UnitEnum|null $navigationGroup = 'Conținut';

    protected static ?string $modelLabel = 'Raport anual';

    protected static ?string $pluralModelLabel = 'Rapoarte anuale';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required(),
            TextInput::make('year')->numeric()->required()->unique(ignoreRecord: true),
            Textarea::make('description')->rows(3)->columnSpanFull(),
            FileUpload::make('file_path')->directory('reports')->label('Fișier PDF'),
            FileUpload::make('cover_image')->image()->directory('reports'),
            DateTimePicker::make('published_at')->default(now()),
            Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('year')->sortable(),
            TextColumn::make('title')->searchable(),
            IconColumn::make('active')->boolean(),
        ])->defaultSort('year', 'desc')
            ->recordActions([EditAction::make(), DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAnnualReports::route('/'),
            'create' => CreateAnnualReport::route('/create'),
            'edit' => EditAnnualReport::route('/{record}/edit'),
        ];
    }
}
