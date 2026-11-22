<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Models\Project;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|\UnitEnum|null $navigationGroup = 'Conținut';

    protected static ?string $modelLabel = 'Proiect';

    protected static ?string $pluralModelLabel = 'Proiecte';

    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informații principale')->schema([
                TextInput::make('title')->label('Titlu')->required()->maxLength(255)->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                Select::make('project_category_id')->label('Categorie')
                    ->relationship('category', 'name')->searchable()->preload(),
                Textarea::make('short_description')->label('Descriere scurtă')->rows(2)->maxLength(500),
                FileUpload::make('featured_image')->image()->directory('projects')->label('Imagine principală'),
            ])->columns(2),

            Section::make('Conținut extins')->schema([
                Textarea::make('description')->label('Descriere completă')->rows(4)->columnSpanFull(),
                Textarea::make('problem')->label('Problemă')->rows(3),
                Textarea::make('solution')->label('Soluție')->rows(3),
                Textarea::make('objectives')->label('Obiective')->rows(3),
                Textarea::make('impact')->label('Impact')->rows(3),
            ])->columns(2)->collapsible(),

            Section::make('Stare și publicare')->schema([
                Select::make('status')->label('Stare')
                    ->options(Project::STATUSES)->default('draft')->required(),
                DateTimePicker::make('published_at')->label('Publicat la'),
                DatePicker::make('start_date')->label('Dată început'),
                DatePicker::make('end_date')->label('Dată sfârșit'),
                TextInput::make('location')->label('Locație'),
                TextInput::make('county')->label('Județ'),
                Toggle::make('featured')->label('Recomandat'),
            ])->columns(2),

            Section::make('Relații')->schema([
                Select::make('partners')->multiple()->relationship('partners', 'name')->preload()->label('Organizații partenere'),
                Select::make('educators')->multiple()->relationship('educators', 'first_name')->preload()->label('Educatori'),
                Select::make('beneficiaries')->multiple()->relationship('beneficiaries', 'name')->preload()->label('Beneficiari'),
            ])->collapsed(),

            Section::make('SEO')->schema([
                TextInput::make('seo_title')->maxLength(255),
                Textarea::make('seo_description')->rows(2)->maxLength(500),
            ])->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')->label('')->height(48),
                TextColumn::make('title')->searchable()->sortable()->limit(50),
                TextColumn::make('category.name')->label('Categorie')->badge()->sortable(),
                TextColumn::make('status')->badge()->sortable()
                    ->color(fn (string $state) => match ($state) {
                        'active' => 'success', 'upcoming' => 'warning',
                        'completed' => 'primary', 'archived' => 'gray', default => 'gray'
                    }),
                TextColumn::make('location')->toggleable(),
                IconColumn::make('featured')->boolean(),
                TextColumn::make('published_at')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options(Project::STATUSES),
                SelectFilter::make('project_category_id')->label('Categorie')->relationship('category', 'name'),
                TernaryFilter::make('featured'),
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
