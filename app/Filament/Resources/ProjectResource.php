<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Conținut';
    protected static ?string $modelLabel = 'Proiect';
    protected static ?string $pluralModelLabel = 'Proiecte';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informații principale')->schema([
                Forms\Components\TextInput::make('title')->label('Titlu')->required()->maxLength(255)->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                Forms\Components\Select::make('project_category_id')->label('Categorie')
                    ->relationship('category', 'name')->searchable()->preload(),
                Forms\Components\Textarea::make('short_description')->label('Descriere scurtă')->rows(2)->maxLength(500),
                Forms\Components\FileUpload::make('featured_image')->image()->directory('projects')->label('Imagine principală'),
            ])->columns(2),

            Forms\Components\Section::make('Conținut extins')->schema([
                Forms\Components\Textarea::make('description')->label('Descriere completă')->rows(4)->columnSpanFull(),
                Forms\Components\Textarea::make('problem')->label('Problemă')->rows(3),
                Forms\Components\Textarea::make('solution')->label('Soluție')->rows(3),
                Forms\Components\Textarea::make('objectives')->label('Obiective')->rows(3),
                Forms\Components\Textarea::make('impact')->label('Impact')->rows(3),
            ])->columns(2)->collapsible(),

            Forms\Components\Section::make('Stare și publicare')->schema([
                Forms\Components\Select::make('status')->label('Stare')
                    ->options(Project::STATUSES)->default('draft')->required(),
                Forms\Components\DateTimePicker::make('published_at')->label('Publicat la'),
                Forms\Components\DatePicker::make('start_date')->label('Dată început'),
                Forms\Components\DatePicker::make('end_date')->label('Dată sfârșit'),
                Forms\Components\TextInput::make('location')->label('Locație'),
                Forms\Components\TextInput::make('county')->label('Județ'),
                Forms\Components\Toggle::make('featured')->label('Recomandat'),
            ])->columns(2),

            Forms\Components\Section::make('Relații')->schema([
                Forms\Components\Select::make('partners')->multiple()->relationship('partners', 'name')->preload()->label('Organizații partenere'),
                Forms\Components\Select::make('educators')->multiple()->relationship('educators', 'first_name')->preload()->label('Educatori'),
                Forms\Components\Select::make('beneficiaries')->multiple()->relationship('beneficiaries', 'name')->preload()->label('Beneficiari'),
            ])->collapsed(),

            Forms\Components\Section::make('SEO')->schema([
                Forms\Components\TextInput::make('seo_title')->maxLength(255),
                Forms\Components\Textarea::make('seo_description')->rows(2)->maxLength(500),
            ])->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')->label('')->height(48),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->limit(50),
                Tables\Columns\TextColumn::make('category.name')->label('Categorie')->badge()->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()->sortable()
                    ->color(fn (string $state) => match ($state) {
                        'active' => 'success', 'upcoming' => 'warning',
                        'completed' => 'primary', 'archived' => 'gray', default => 'gray'
                    }),
                Tables\Columns\TextColumn::make('location')->toggleable(),
                Tables\Columns\IconColumn::make('featured')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(Project::STATUSES),
                Tables\Filters\SelectFilter::make('project_category_id')->label('Categorie')->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('featured'),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
