<?php
namespace App\Filament\Resources\BeneficiaryRequestResource\Pages;
use App\Filament\Resources\BeneficiaryRequestResource;
use Filament\Resources\Pages\EditRecord;
class EditBeneficiaryRequest extends EditRecord { protected static string $resource = BeneficiaryRequestResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\DeleteAction::make()]; } }
