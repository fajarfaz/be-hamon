<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HardwareController;

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
    return ['version' => '1.0'];
});

Route::get('/hardware', [HardwareController::class, 'index']);
Route::post('/hardware/create', [HardwareController::class, 'create']);
Route::post('/login', [HardwareController::class, 'login']);
// Route::post('/sender/bookmark', [Sender::class, 'bookmark']);