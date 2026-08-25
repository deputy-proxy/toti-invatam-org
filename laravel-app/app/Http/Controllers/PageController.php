<?php

namespace App\Http\Controllers;

use App\Models\AnnualReport;
use App\Models\Beneficiary;
use App\Models\ImpactMetric;
use App\Models\NewsArticle;
use App\Models\Organization;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'partners' => Partner::active()->featured()->with('organization')->orderBy('display_order')->take(8)->get(),
            'metrics' => ImpactMetric::global()->active()->ordered()->get(),
            'featuredProjects' => Project::featured()->published()->latest('published_at')->take(3)->get(),
            'testimonials' => Testimonial::active()->featured()->ordered()->take(3)->get(),
            'latestNews' => NewsArticle::published()->latest('published_at')->take(3)->get(),
        ]);
    }

    public function about() { return view('pages.about'); }
    public function howItWorks() { return view('pages.how-it-works'); }

    public function impact()
    {
        return view('pages.impact', [
            'metrics' => ImpactMetric::global()->active()->ordered()->get(),
            'testimonials' => Testimonial::active()->take(6)->get(),
            'projects' => Project::published()->latest()->take(6)->get(),
        ]);
    }

    public function involve() { return view('pages.involve'); }
    public function corporate() { return view('pages.corporate'); }
    public function beneficiaries() { return view('pages.beneficiaries'); }
    public function volunteer() { return view('pages.volunteer'); }
    public function contact() { return view('pages.contact'); }

    public function annualReports()
    {
        return view('pages.annual-reports', [
            'reports' => AnnualReport::where('active', true)->orderByDesc('year')->get(),
        ]);
    }

    public function partners()
    {
        $partners = Partner::active()->with('organization')->orderBy('display_order')->get()
            ->groupBy(fn ($p) => $p->organization->type);
        return view('pages.partners', compact('partners'));
    }
}
