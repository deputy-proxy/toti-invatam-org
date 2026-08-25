<?php
namespace App\Filament\Resources\VolunteerApplicationResource\Pages;
use App\Filament\Resources\VolunteerApplicationResource;
use Filament\Resources\Pages\ListRecords;
class ListVolunteerApplications extends ListRecords { protected static string $resource = VolunteerApplicationResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
