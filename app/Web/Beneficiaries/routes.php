<?php
Route::resource('beneficiaries', App\Web\Beneficiaries\BeneficiariesController::class)->only('update');
