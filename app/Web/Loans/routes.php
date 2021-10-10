<?php
Route::post('/loans/new-client',[App\Web\Loans\LoansController::class,'newClient'])->name('loans.new-client');
Route::get('/loans/for-approval',[App\Web\Loans\LoansController::class,'for_approval'])->name('loans.for-approval');
Route::patch('/loans/commit-approval/{type}',[App\Web\Loans\LoansController::class,'commitApproval'])->name('loans.commit-approval');
Route::get('/loans/approved',[App\Web\Loans\LoansController::class,'approved'])->name('loans.approved');
Route::put('/loans/commit-charge/{loan}/{charge}/{type}',[App\Web\Loans\LoansController::class,'commitCharge'])->name('loans.commit-charge');
Route::patch('/loans/change-charge-amount/{loanChargeId}',[App\Web\Loans\LoansController::class,'chargeChangeAmount'])->name('loans.change-charge_amount');
Route::patch('/loans/move-to-for-release/{loan}',[App\Web\Loans\LoansController::class,'moveToForRelease'])->name('loans.move-to-for_release');
Route::get('/loans/for-releasing',[App\Web\Loans\LoansController::class,'for_releasing'])->name('loans.for-releasing');
Route::patch('/loans/commit-include/{loan}/{action}',[App\Web\Loans\LoansController::class,'commitInclude'])->name('loans.commit-include');
Route::get('/loans/released',[App\Web\Loans\LoansController::class,'released'])->name('loans.released');
Route::any('loans/json-data',[App\Web\Loans\LoansController::class,'jsonData'])->name('loans.jsonData');
Route::resource('loans', App\Web\Loans\LoansController::class)->only('index','store','update','destroy','create');
