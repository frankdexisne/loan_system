<?php
Route::patch('/users/{user}/assign-role',[App\Web\Users\UsersController::class,'assignRole'])->name('users.assignRole');
Route::patch('/users/{user}/reset-password',[App\Web\Users\UsersController::class,'resetPassword'])->name('users.resetPassword');
Route::any('users/json-data',[App\Web\Users\UsersController::class,'jsonData'])->name('users.jsonData');
Route::resource('users', App\Web\Users\UsersController::class)->only('index','store','update','destroy');
?>
