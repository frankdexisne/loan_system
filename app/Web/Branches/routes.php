<?php
Route::any('branches/json-data',[App\Web\Branches\BranchesController::class,'jsonData'])->name('branches.jsonData');
Route::resource('branches', App\Web\Branches\BranchesController::class)->only('index','store','update','destroy');
