<?php
Route::any('payments/json-data',[App\Web\Payments\PaymentsController::class,'jsonData'])->name('payments.jsonData');
Route::resource('payments', App\Web\Payments\PaymentsController::class)->only('index','store','update','destroy');
