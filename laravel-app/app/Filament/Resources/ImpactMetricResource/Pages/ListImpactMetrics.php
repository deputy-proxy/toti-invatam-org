<?php
namespace App\Filament\Resources\ImpactMetricResource\Pages;
use App\Filament\Resources\ImpactMetricResource;
use Filament\Resources\Pages\ListRecords;
class ListImpactMetrics extends ListRecords { protected static string $resource = ImpactMetricResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; } }
