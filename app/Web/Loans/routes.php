<?php
Route::get('/loans/for-approval',[App\Web\Loans\LoansController::class,'for_approval'])->name('loans.for-approval');
Route::get('/loans/approved',[App\Web\Loans\LoansController::class,'approved'])->name('loans.approved');
Route::get('/loans/for-releasing',[App\Web\Loans\LoansController::class,'for_releasing'])->name('loans.for-releasing');
Route::get('/loans/released',[App\Web\Loans\LoansController::class,'released'])->name('loans.released');
Route::any('loans/json-data',[App\Web\Loans\LoansController::class,'jsonData'])->name('loans.jsonData');
Route::resource('loans', App\Web\Loans\LoansController::class)->only('index','store','update','destroy');
