<?php
Route::resource('co_makers', App\Web\CoMakers\CoMakersController::class)->only('update');
