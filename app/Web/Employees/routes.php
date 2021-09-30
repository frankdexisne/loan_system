<?php
Route::put('employees/{employee}/add-as-user',[App\Web\Employees\EmployeeController::class,'addAsUser'])->name('users.addAsUser');
Route::any('employees/json-data',[App\Web\Employees\EmployeeController::class,'jsonData'])->name('users.jsonData');
Route::resource('employees', App\Web\Employees\EmployeeController::class)->only('index','store','update','destroy');
