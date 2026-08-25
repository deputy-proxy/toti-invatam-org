<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [PageController::class, 'home'])->name('home');

// Static pages
Route::get('/despre-noi',                  [PageController::class, 'about'])->name('about');
Route::get('/cum-functioneaza',            [PageController::class, 'howItWorks'])->name('how-it-works');
Route::get('/impact',                      [PageController::class, 'impact'])->name('impact');
Route::get('/implica-te',                  [PageController::class, 'involve'])->name('involve');
Route::get('/pentru-companii',             [PageController::class, 'corporate'])->name('corporate');
Route::get('/beneficiari',                 [PageController::class, 'beneficiaries'])->name('beneficiaries');
Route::get('/voluntariat',                 [PageController::class, 'volunteer'])->name('volunteer');
Route::get('/contact',                     [PageController::class, 'contact'])->name('contact');
Route::get('/raport-anual',                [PageController::class, 'annualReports'])->name('annual-reports');
Route::get('/parteneri',                   [PageController::class, 'partners'])->name('partners');
Route::get('/politica-de-confidentialitate', fn () => view('pages.legal.privacy'))->name('legal.privacy');
Route::get('/termeni-si-conditii',           fn () => view('pages.legal.terms'))->name('legal.terms');
Route::get('/cookies',                       fn () => view('pages.legal.cookies'))->name('legal.cookies');

// Content collections
Route::get('/proiecte',              [ProjectController::class, 'index'])->name('projects.index');
Route::get('/proiecte/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/noutati',               [NewsController::class, 'index'])->name('news.index');
Route::get('/noutati/{article:slug}',[NewsController::class, 'show'])->name('news.show');

Route::get('/resurse',                       [ResourceController::class, 'index'])->name('resources.index');
Route::get('/resurse/{resource:slug}',       [ResourceController::class, 'show'])->name('resources.show');

Route::get('/evenimente',                    [EventController::class, 'index'])->name('events.index');
Route::get('/evenimente/{event:slug}',       [EventController::class, 'show'])->name('events.show');

// Donation
Route::get('/doneaza',                   [DonationController::class, 'show'])->name('donate');
Route::post('/doneaza',                  [DonationController::class, 'store'])->name('donate.store');
Route::get('/doneaza/multumesc/{donation}', [DonationController::class, 'thanks'])->name('donate.thanks');
