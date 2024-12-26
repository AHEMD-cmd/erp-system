<?php

use App\Models\Setting;
use App\Models\Treasury;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UomController;
use App\Http\Controllers\Admin\LoginContoller;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\SettingContoller;
use App\Http\Controllers\Admin\TreasuryContoller;
use App\Http\Controllers\Admin\DashboardContoller;
use App\Http\Controllers\Admin\ItemCardController;
use App\Http\Controllers\Admin\AccountTypeController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\ItemCardCategoryController;
use App\Http\Controllers\Admin\SalesMaterialTypeController;


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

define('PAGINATION_COUNT', 1);

Route::get('/', function () {
    return view('layouts.admin');
});
Route::get('/login', function () {
    return view('admin.auth.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin', 'as' => 'admin.'],function () {
        
        Route::get('/login', [LoginContoller::class, 'showLogin'])->name('login');
        Route::post('/login', [LoginContoller::class, 'Login'])->name('login');
    }
);

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin', 'as' => 'admin.'],function () {
        Route::get('/logout', [LoginContoller::class, 'logout'])->name('logout');
        Route::get('/', [DashboardContoller::class, 'index'])->name('dashboard');
        Route::resource('/settings', SettingContoller::class)->only(['index', 'edit', 'update']);
        Route::resource('/treasuries', TreasuryContoller::class);
        Route::resource('sales-material-types', SalesMaterialTypeController::class);
        Route::resource('stores', StoreController::class);
        Route::resource('uoms', UomController::class);
        Route::resource('item-card-categories', ItemCardCategoryController::class);
        Route::resource('item-cards', ItemCardController::class);
        Route::resource('account-types', AccountTypeController::class);

        
    }
);
