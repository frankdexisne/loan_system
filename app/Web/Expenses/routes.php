<?php
Route::any('expenses/json-data',[App\Web\Expenses\ExpensesController::class,'jsonData'])->name('expenses.jsonData');
Route::resource('expenses', App\Web\Expenses\ExpensesController::class)->only('index','store','update','destroy');
