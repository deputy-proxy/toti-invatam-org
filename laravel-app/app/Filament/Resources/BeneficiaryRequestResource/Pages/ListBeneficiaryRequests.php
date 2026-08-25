<?php
namespace App\Filament\Resources\BeneficiaryRequestResource\Pages;
use App\Filament\Resources\BeneficiaryRequestResource;
use Filament\Resources\Pages\ListRecords;
class ListBeneficiaryRequests extends ListRecords { protected static string $resource = BeneficiaryRequestResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
