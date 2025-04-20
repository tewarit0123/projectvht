<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\FormElderlyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormAnalysisController;
use App\Http\Controllers\FormVolunteerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormVillageController;
use App\Http\Controllers\chvinvillageController;
use App\Http\Controllers\userinelderController;
use App\Http\Controllers\elderinvolunteerController;
use App\Http\Controllers\elderlyController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\VolunteerAssessmentController;
use App\Http\Controllers\MonthlySurveyController;
use App\Http\Controllers\doctorController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




Route::middleware('auth:chv')->group(function () {
    // middleware ส่วนนี้มีปัญหา
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/volunteers', [VolunteerController::class, 'index'])->name('volunteers.index');
    Route::post('/volunteers/store', [VolunteerController::class, 'store'])->name('store.volunteer');
    Route::get('/volunteers/create', [VolunteerController::class, 'create'])->name('volunteers.create');
    Route::get('/volunteers/{id}/edit', [VolunteerController::class, 'edit'])->name('volunteers.edit');
    Route::put('/volunteers/{id}', [VolunteerController::class, 'update'])->name('volunteers.update');
    Route::delete('/volunteers/{id}', [VolunteerController::class, 'destroy'])->name('volunteers.destroy');

    Route::get('/volunteerss', [VolunteerAssessmentController::class, 'index'])->name('volunteerss');

    Route::get('/elderly', [AuthController::class, 'showElderly'])->name('elderly');

    Route::get('formelderly', [FormElderlyController::class, 'index'])->name('formelderly');

    Route::post('formelderly', [FormElderlyController::class, 'store'])->name('formelderly.store');

    // Adding the missing route for formelderlyindex
    Route::get('/formelderlyindex', [FormElderlyController::class, 'index'])->name('formelderlyindex');
    // Adding the missing route for formelderlyedit
    Route::get('/formelderlyedit/{id}', [FormElderlyController::class, 'edit'])->name('formelderlyedit');
    Route::delete('/formelderly/{e_id}', [FormElderlyController::class, 'destroy'])->name('formelderly.destroy');
    Route::put('/formelderly/{e_id}', [FormElderlyController::class, 'update'])->name('formelderly.update');

    Route::post('/formvolunteer', [FormVolunteerController::class, 'store'])->name('formvolunteer.store');
    Route::get('/formvolunteerindex', [FormVolunteerController::class, 'index'])->name('formvolunteerindex');
    Route::get('/formvolunteer/{idchv}/edit', [FormVolunteerController::class, 'edit'])->name('formvolunteer.edit');
    Route::put('/formvolunteer/{idchv}', [FormVolunteerController::class, 'update'])->name('formvolunteer.update');
    Route::delete('/formvolunteer/{id}', [FormVolunteerController::class, 'destroy'])->name('formvolunteer.destroy');

    // Adding the missing route for formvolunteeredit
    Route::get('/formvolunteeredit/{idchv}', [FormVolunteerController::class, 'edit'])->name('formvolunteeredit');

    Route::post('/formvillage', [FormVillageController::class, 'store'])->name('formvillageindex.store');

    Route::get('/village', [FormVillageController::class, 'index'])->name('formvillageindex');

    Route::get('/formvillage/{v_id}/edit', [FormVillageController::class, 'edit'])->name('formvillage.edit');
    Route::put('/formvillage/{v_id}', [FormVillageController::class, 'update'])->name('formvillage.update');
    Route::delete('/formvillage/{v_id}', [FormVillageController::class, 'destroy'])->name('formvillageindex.destroy');

    // Adding the missing route for chvinvillage
    Route::get('/chvinvillage', [chvinvillageController::class, 'index'])->name('chvinvillage');
    Route::post('/chvinvillage/store', [chvinvillageController::class, 'store'])->name('chvinvillage.store'); // Added route for storing chvinvillage
    Route::post('/chvinvillage/chvjoin', [chvinvillageController::class, 'chvjoin'])->name('chvinvillage.chvjoin'); // Added route for chvjoin chvinvillage
    Route::delete('/chvinvillage/{id}', [chvinvillageController::class, 'destroy'])->name('chvinvillage.destroy'); // Added route for deleting chvinvillage
    Route::post('/chvinvillage/{id}/{status}', [chvinvillageController::class, 'upstatus'])->name('chvinvillage.upstatus'); // Added route for chvjoin chvinvillage

    Route::get('/userinelder', [userinelderController::class, 'index'])->name('userinelder');
    Route::delete('/userinelder/{u_id}', [userinelderController::class, 'destroy'])->name('userinelder.destroy');
    Route::put('/userinelder/{u_id}', [userinelderController::class, 'update'])->name('userinelder.update');

    Route::get('/doctor', [doctorController::class, 'index'])->name('doctor');

    // Route::get('/elderinvolunteer', [elderinvolunteerController::class, 'index'])->name('elderinvolunteer');
    // Route::post('/elderinvolunteer/store', [elderinvolunteerController::class, 'store'])->name('elderinvolunteer.store');
    // Route::put('/elderinvolunteer/{id}', [elderinvolunteerController::class, 'update'])->name('elderinvolunteer.update');
    // Route::delete('/elderinvolunteer/{id}', [elderinvolunteerController::class, 'destroy'])->name('elderinvolunteer.destroy');

    Route::get('/api/chvin_v/{v_id}', [elderinvolunteerController::class, 'chvine'])->name('elderinvolunteer.chvine');
    Route::post('/store-chv-elder', [elderinvolunteerController::class, 'storeChvElder']);

    Route::post('/userinelder', [userinelderController::class, 'store'])->name('userinelder.store');

    Route::get('/formanalysis/{e_id?}', [FormAnalysisController::class, 'index'])->name('formanalysis');
 
    

    Route::get('/pdf/elder-report', [FormVolunteerController::class, 'elderReport'])->name('elder.report');
    Route::delete('/pdf/elder/{id}', [FormVolunteerController::class, 'destroy'])->name('elder.destroy');
    Route::put('/pdf/elder/{id}', [FormVolunteerController::class, 'update'])->name('elder.update');

    Route::get('/elder-report/export-pdf/{volunteerId}', [FormVolunteerController::class, 'exportPDF'])->name('elder.export.pdf');

    Route::get('/volunteer-assessment', [VolunteerAssessmentController::class, 'index'])->name('volunteer.assessment');
    Route::get('/get-elder-details', [VolunteerAssessmentController::class, 'getElderDetails']);

    Route::post('/store-volunteer', [VolunteerAssessmentController::class, 'store'])->name('store.volunteer');
    
Route::post('/monthly-survey', [MonthlySurveyController::class, 'store'])->name('monthly-survey.store');
});

// require __DIR__ . '/auth.php';
Route::get('/elderly/dashboard', [elderlyController::class, 'dashboard'])->name('elder.dashboard');

