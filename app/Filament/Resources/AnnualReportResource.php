<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnualReportResource\Pages;
use App\Models\AnnualReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AnnualReportResource extends Resource
{
    protected static ?string $model = AnnualReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationGroup = 'Conținut';

    protected static ?string $modelLabel = 'Raport anual';

    protected static ?string $pluralModelLabel = 'Rapoarte anuale';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\TextInput::make('year')->numeric()->required()->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
            Forms\Components\FileUpload::make('file_path')->directory('reports')->label('Fișier PDF'),
            Forms\Components\FileUpload::make('cover_image')->image()->directory('reports'),
            Forms\Components\DateTimePicker::make('published_at')->default(now()),
            Forms\Components\Toggle::make('active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('year')->sortable(),
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\IconColumn::make('active')->boolean(),
        ])->defaultSort('year', 'desc')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnnualReports::route('/'),
            'create' => Pages\CreateAnnualReport::route('/create'),
            'edit' => Pages\EditAnnualReport::route('/{record}/edit'),
        ];
    }
}
