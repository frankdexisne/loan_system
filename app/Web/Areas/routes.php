<?php
Route::any('areas/json-data',[App\Web\Areas\AreasController::class,'jsonData'])->name('areas.jsonData');
Route::resource('areas', App\Web\Areas\AreasController::class)->only('index','store','update','destroy');
