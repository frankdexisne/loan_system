<?php
Route::any('charges/json-data',[App\Web\Charges\ChargesController::class,'jsonData'])->name('areas.jsonData');
Route::resource('charges', App\Web\Charges\ChargesController::class)->only('index','store','update','destroy');
