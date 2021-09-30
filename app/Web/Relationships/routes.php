<?php
Route::any('relationships/json-data',[App\Web\Relationships\RelationshipsController::class,'jsonData'])->name('relationships.jsonData');
Route::resource('relationships', App\Web\Relationships\RelationshipsController::class)->only('index','store','update','destroy');
