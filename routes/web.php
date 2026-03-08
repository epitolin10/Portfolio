<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\ActiviteController;
use App\Http\Controllers\Admin\CompetenceController;
use App\Http\Controllers\Admin\StageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CaptureController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Portfolio public
|--------------------------------------------------------------------------
*/
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/competences', [PortfolioController::class, 'competences'])->name('portfolio.competences');
Route::get('/activites', [PortfolioController::class, 'activites'])->name('portfolio.activites');
Route::get('/activites/{slug}', [PortfolioController::class, 'activiteShow'])->name('portfolio.activites.show');
Route::get('/stages', [PortfolioController::class, 'stages'])->name('portfolio.stages');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('portfolio.contact');

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin — protégé par auth
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Activités CRUD
    Route::resource('activites', ActiviteController::class);
    Route::post('activites/{activite}/toggle-visible', [ActiviteController::class, 'toggleVisible'])
        ->name('activites.toggle-visible');

    // Supprimer une capture
    Route::delete('captures/{capture}', [CaptureController::class, 'destroy'])
        ->name('captures.destroy');

    // Compétences
    Route::resource('competences', CompetenceController::class)->only(['index', 'edit', 'update']);

    // Stages CRUD
    Route::resource('stages', StageController::class);
});