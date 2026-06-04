<?php

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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

use App\Http\Controllers\NotesiteApiController;

Route::get('/', function () {
    $path = base_path('public/notesite.php');

    return response(file_get_contents($path), 200, ['Content-Type' => 'text/html']);
});

Route::any('/api.php', [NotesiteApiController::class, 'handle'])
    ->middleware('web')
    ->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/welcome', function () {
    return view('welcome');
});
