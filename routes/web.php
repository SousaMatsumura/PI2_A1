<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\School\{
    Dashboard\DashboardController as SchoolDashboardController,
    Inventory\InventoryController as SchoolInventoryController,
    Consumption\ConsumptionController as SchoolConsumptionController
};
use App\Http\Controllers\Secretary\Dashboard\DashboardController as SecretaryDashboardController;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::middleware('auth')->group(function(){

    Route::middleware('institution.type:SCHOOL')->prefix('escola')->group(function(){
        Route::get('painel', [SchoolDashboardController::class, 'index'])->name('school.dashboard.index');
        Route::get('estoque', [SchoolInventoryController::class, 'index'])->name('school.inventory.index');
        Route::get('consumos', [SchoolConsumptionController::class, 'index'])->name('school.consumption.index');
        Route::get('consumo/cadastrar', [SchoolConsumptionController::class, 'create'])->name('school.consumption.create');
        Route::post('consumo/cadastrar', [SchoolConsumptionController::class, 'store'])->name('school.consumption.store');
    });

    Route::middleware('institution.type:SECRETARY')->prefix('secretaria')->group(function(){
        Route::get('painel', [SecretaryDashboardController::class, 'index'])->name('secretary.dashboard.index');
    });
    
});



Route::get('teste', function(){


    foreach(\App\Models\Inventory::all() as $inventory) {

        echo $inventory->food->name.'<br>';
        echo $inventory->school->user->name.'<br>';
        echo $inventory->quantity.'<br>';
        echo '<br>';

    }


});