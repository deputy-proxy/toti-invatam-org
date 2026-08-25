<?php
namespace App\Filament\Resources\ImpactMetricResource\Pages;
use App\Filament\Resources\ImpactMetricResource;
use Filament\Resources\Pages\EditRecord;
class EditImpactMetric extends EditRecord { protected static string $resource = ImpactMetricResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\DeleteAction::make()]; } }
