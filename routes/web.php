<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');

Route::group(['middleware' => ['auth']], function () {

    foreach (scandir($path = app_path('Web')) as $dirName) {
        if (file_exists($filepath = $path.'/'.$dirName.'/routes.php')) {
            include $filepath;
        }
    }
});
