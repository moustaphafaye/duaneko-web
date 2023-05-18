<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\CompanyController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'index']);

Auth::routes();

Route::get('/pages/login', [PageController::class, 'login'])->name('login');
Route::post('/pages/login', [PageController::class, 'loginUser'])->name('login');

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard/agents', [AgentController::class, 'create'])->name('agents');
    Route::post('/dashboard/agents', [AgentController::class, 'store'])->name('agents');
    Route::get('/dashboard/listAgents', [AgentController::class, 'index'])->name('listAgents');
    // Route::get('/dashboard/showAgents/{agent}', [AgentController::class, 'showData'])->name('updateAgents');
    Route::get('/dashboard/showAgents/{agent}', [AgentController::class, 'show'])->name('showAgents');
    Route::put('/dashboard/updateAgents/{agent}', [AgentController::class, 'update'])->name('updateAgents');
    Route::delete('/dashboard/deleteAgents/{agent}', [AgentController::class, 'delete'])->name('deleteAgents');

    Route::get('/dashboard/signaller','signaller')->name('signale');
    Route::get('/dashboard/home', 'index')->name('dashboard');
    Route::get('/dashboard/report', 'report')->name('report');
    Route::get('/dashboard/detailsReports', [DashboardController::class, 'detailsReports'])->name('detailsReports');
    Route::get('/dashboard/reports/{id}', [DashboardController::class, 'showReport']);
    Route::get('/dashboard/agents', 'agents')->name('agents');

    Route::get('/dashboard/companies', [CompanyController::class, 'create'])->name('companies');
    Route::post('/dashboard/companies', [CompanyController::class, 'store'])->name('companies');
    Route::get('/dashboard/listCompanies', [CompanyController::class, 'index'])->name('listCompanies');
    // Route::get('/dashboard/showCompanies/{company}', [CompanyController::class, 'showData'])->name('updateCompanies');
    Route::get('/dashboard/showCompanies/{company}', [CompanyController::class, 'show'])->name('showCompanies');
    Route::put('/dashboard/updateCompanies/{company}', [CompanyController::class, 'update'])->name('updateCompanies');
    Route::delete('/dashboard/deleteCompanies/{company}', [CompanyController::class, 'delete'])->name('deleteCompanies');
});
Route::get('/dashboard/evenement' ,[EvenementController::class,'formEvenement'] )->name('eventform');
Route::post('/dashboard/evenement' ,[EvenementController::class,'creer'] )->name('creerEvenement');
Route::get('/dashboard/listEvenement' ,[EvenementController::class,'listevent'] )->name('liste_evenement');

Route::get('/dashboard/showEvenement/{event}' ,[EvenementController::class,'show'] )->name('show_evenement');
Route::put('/dashboard/updateEvenement/{event}' ,[EvenementController::class,'update'] )->name('update_evenement');
Route::delete('/dashboard/deleteEvenement/{event}', [EvenementController::class, 'delete'])->name('delete_evenement');
Route::get('dashboard/mesagents', [AgentController::class , 'MyAgents'])->name('mesagents');

Route::get('reporyzone',[DashboardController::class , 'reportzone'])->name('reportzone');








