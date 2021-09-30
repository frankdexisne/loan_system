<?php
Route::get('/roles/{role}/get-permissions',[App\Web\Roles\RolesController::class,'getPermissions'])->name('roles.getPermissions');
Route::patch('/roles/{role}/assign-permissions',[App\Web\Roles\RolesController::class,'assignPermissions'])->name('roles.assignPermissions');
Route::any('roles/json-data',[App\Web\Roles\RolesController::class,'jsonData'])->name('roles.jsonData');
Route::resource('roles', App\Web\Roles\RolesController::class)->only('index','store','update','destroy');
