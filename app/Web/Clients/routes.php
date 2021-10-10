<?php
Route::any('clients/json-data',[App\Web\Clients\ClientsController::class,'jsonData'])->name('clients.jsonData');
Route::resource('clients', App\Web\Clients\ClientsController::class)->only('index','store','update','destroy');
