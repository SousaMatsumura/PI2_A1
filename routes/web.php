<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\School\{
    Dashboard\DashboardController as SchoolDashboardController,
    FoodRecord\FoodRecordController as SchoolFoodRecordControllerController,
    Consumption\ConsumptionController as SchoolConsumptionController,
    Menu\MenuController as SchoolMenuControlller
};
use App\Http\Controllers\Secretary\{
    Dashboard\DashboardController as SecretaryDashboardController,
    Institution\InstitutionController
};

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::middleware('auth')->group(function(){

    Route::middleware('institution.type:SCHOOL')->prefix('escola')->group(function(){
        Route::get('painel', [SchoolDashboardController::class, 'index'])->name('school.dashboard.index');
        Route::get('estoque', [SchoolFoodRecordControllerController::class, 'index'])->name('school.food_record.index');
        Route::get('consumos', [SchoolConsumptionController::class, 'index'])->name('school.consumption.index');
        Route::get('consumo/cadastrar', [SchoolConsumptionController::class, 'create'])->name('school.consumption.create');
        Route::post('consumo/cadastrar', [SchoolConsumptionController::class, 'store'])->name('school.consumption.store');
        Route::patch('consumo/atualizar', [SchoolConsumptionController::class, 'update'])->name('school.consumption.update');

        Route::get('cardapios', [SchoolMenuControlller::class, 'create'])->name('school.menu.index');
        Route::get('cardapio', [SchoolMenuControlller::class, 'create'])->name('school.menu.create');
        Route::post('cardapio', [SchoolMenuControlller::class, 'store'])->name('school.menu.store');
        Route::patch('cardapio/atualizar', [SchoolMenuControlller::class, 'update'])->name('school.menu.update');

    });

    Route::middleware('institution.type:SECRETARY')->prefix('secretaria')->group(function(){
        Route::get('painel', [SecretaryDashboardController::class, 'index'])->name('secretary.dashboard.index');
        Route::get('instituicao', [InstitutionController::class, 'index'])->name('secretary.institution.index');
        Route::get('instituicao/cadastrar', [InstitutionController::class, 'create'])->name('secretary.institution.create');
        Route::post('instituicao', [InstitutionController::class, 'store'])->name('secretary.institution.store');
    });
    
});



Route::get('teste', function(){

});