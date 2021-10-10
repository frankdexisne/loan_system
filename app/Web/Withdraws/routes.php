<?php
Route::any('withdraws/json-data',[App\Web\Withdraws\WithdrawsController::class,'jsonData'])->name('withdraws.jsonData');
Route::resource('withdraws', App\Web\Withdraws\WithdrawsController::class)->only('index','store','update','destroy');
