<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OnlineScreeningController;
use App\Http\Controllers\FeedbackController;
use App\Models\Feedback;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/diabetes', [OnlineScreeningController::class, 'index'])->name('diabetes.index');
Route::post('/diabetes/submit', [OnlineScreeningController::class, 'submitScreening'])->name('diabetes.submit');
Route::get('/diabetes/result', [OnlineScreeningController::class, 'result'])->name('diabetes.result');


// Route untuk mengambil data kuesioner
Route::get('kuesioner', [OnlineScreeningController::class, 'getQuestions']);

// Route untuk menyimpan data screening
Route::post('screening', [OnlineScreeningController::class, 'store']);



Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');


