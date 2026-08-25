<?php

namespace App\Filament\Widgets;

use App\Models\BeneficiaryRequest;
use App\Models\Donation;
use App\Models\Organization;
use App\Models\PartnershipInquiry;
use App\Models\Person;
use App\Models\Project;
use App\Models\VolunteerApplication;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverviewStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Proiecte active', Project::where('status', 'active')->count())
                ->description('Programe în derulare')
                ->color('primary'),
            Stat::make('Educatori', Person::where('active', true)->count())
                ->description('Persoane înregistrate')
                ->color('warning'),
            Stat::make('Parteneri', Organization::where('active', true)->count())
                ->description('Organizații partenere')
                ->color('success'),
            Stat::make('Voluntari - cereri în așteptare', VolunteerApplication::where('status', 'pending')->count())
                ->color('danger'),
            Stat::make('Cereri sprijin (nou)', BeneficiaryRequest::where('status', 'new')->count())
                ->color('danger'),
            Stat::make('Inquiries parteneriat (nou)', PartnershipInquiry::where('status', 'new')->count())
                ->color('danger'),
            Stat::make('Donații total (RON)', number_format(Donation::where('status', 'completed')->sum('amount'), 0, ',', '.'))
                ->color('success'),
        ];
    }
}
