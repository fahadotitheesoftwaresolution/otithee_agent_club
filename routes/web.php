<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AgentProfileController,
    PlanningController,
    TrainingController,
    DocumentController,
    IssuesController,
    ApplicationController,
    LinksController,
    PublicationController,
    TutorialController,
    AgentClubRankingController,
};
use App\Http\Controllers\Auth\AuthController;

// Dashboard Login
Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

// Dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Agent Profile
Route::resource('agent_profile', AgentProfileController::class);
//Agent Club Ranking
Route::resource('agent_club_ranking', AgentClubRankingController::class);
//Planning & Scheduling
Route::resource('plannings', PlanningController::class);
//Training Schedule
Route::resource('trainings', TrainingController::class);
//Documents
Route::resource('documents', DocumentController::class);
//Upcomming Issues
Route::resource('uissues', IssuesController::class);
//Applications
Route::resource('applications', ApplicationController::class);
//Essential Links
Route::resource('elinks', LinksController::class);
//Publications
Route::resource('publications', PublicationController::class);
//Tutorial
Route::resource('tutorials', TutorialController::class);

Route::get('/fdgdf', [App\Http\Controllers\YaminController::class, 'index'])->name('MyNameisYamin');

//Route::resource('agent_ranking', AgentRankingController::class);