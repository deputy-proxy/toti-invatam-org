<?php
namespace App\Filament\Resources\ProjectCategoryResource\Pages;
use App\Filament\Resources\ProjectCategoryResource;
use Filament\Resources\Pages\EditRecord;
class EditProjectCategory extends EditRecord { protected static string $resource = ProjectCategoryResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\DeleteAction::make()]; } }
