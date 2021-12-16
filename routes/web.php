<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\School\{
    Dashboard\DashboardController as SchoolDashboardController,
    FoodRecord\FoodRecordController as SchoolFoodRecordControllerController,
    Consumption\ConsumptionController as SchoolConsumptionController,
    Menu\MenuController as SchoolMenuControlller,
    Institution\InstitutionController as SchoolInstitutionController
};
use App\Http\Controllers\Secretary\{
    Dashboard\DashboardController as SecretaryDashboardController,
    Institution\InstitutionController,
    Institution\Data\InstitutionDataController,
    Institution\Consumption\InstitutionConsumptionController,
    Institution\FoodRecord\InstitutionFoodRecordController,
    Institution\Report\InstitutionReportController,
    Institution\Meal\InstitutionMealController,
    School\FoodRecordController as SecretarySchoolFoodRecordController,
    User\UserController as SecretaryUserController,
    Food\FoodController as SecretaryFoodController,
    Food\RestoreController as SecretaryFoodRestoreController,
    User\RestoreController as SecretaryUserRestoreController
};
use App\Models\Institution;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function(){

    Route::middleware('institution.type:SCHOOL')->prefix('escola')->group(function(){
        Route::get('painel', [SchoolDashboardController::class, 'index'])->name('school.dashboard.index');
        Route::get('estoque', [SchoolFoodRecordControllerController::class, 'index'])->name('school.food_record.index');
        Route::get('consumos', [SchoolConsumptionController::class, 'index'])->name('school.consumption.index');
        Route::get('consumo/cadastrar', [SchoolConsumptionController::class, 'create'])->name('school.consumption.create');
        Route::post('consumo/cadastrar', [SchoolConsumptionController::class, 'store'])->name('school.consumption.store');
        Route::patch('consumo/atualizar', [SchoolConsumptionController::class, 'update'])->name('school.consumption.update');

        Route::get('cardapios', [SchoolMenuControlller::class, 'index'])->name('school.menu.index');
        Route::get('cardapio', [SchoolMenuControlller::class, 'create'])->name('school.menu.create');
        Route::post('cardapio', [SchoolMenuControlller::class, 'store'])->name('school.menu.store');
        Route::patch('cardapio/atualizar', [SchoolMenuControlller::class, 'update'])->name('school.menu.update');

        Route::get('cadastro', [SchoolInstitutionController::class, 'edit'])->name('school.institution.edit');
        Route::patch('cadastro', [SchoolInstitutionController::class, 'update'])->name('school.institution.update');

    });

    Route::middleware('institution.type:SECRETARY')->prefix('secretaria')->group(function(){
        
        // Entrada de Alimentos
        Route::get('escola/entrada-alimentos/', [SecretarySchoolFoodRecordController::class, 'index'])->name('secretary.school.food_record.index');
        Route::get('escola/{institution}/entrada-alimentos', [SecretarySchoolFoodRecordController::class, 'create'])->name('secretary.school.food_record.create');
        Route::post('escola/{institution}/entrada-alimentos', [SecretarySchoolFoodRecordController::class, 'store'])->name('secretary.school.food_record.store');
        Route::patch('escola/{institution}/entrada-alimentos/atualizar', [SecretarySchoolFoodRecordController::class, 'update'])->name('secretary.school.food_record.update');
        
        
        Route::get('painel', [SecretaryDashboardController::class, 'index'])->name('secretary.dashboard.index');
        Route::get('instituicao', [InstitutionController::class, 'index'])->name('secretary.institution.index');
        Route::get('instituicao/cadastrar', [InstitutionController::class, 'create'])->name('secretary.institution.create');
        Route::post('instituicao', [InstitutionController::class, 'store'])->name('secretary.institution.store');
        Route::get('escola/{institution}', [InstitutionController::class, 'show'])->name('secretary.institution.show');
        
        /*
        Route::get('escola/{institution}/edit', [InstitutionController::class, 'edit'])->name('secretary.institution.edit');
        Route::put('escola/{instituicao}', [InstitutionController::class, 'update'])->name('secretary.institution.update');
        */

        Route::delete('escola/{institution}', [InstitutionController::class, 'destroy'])->name('secretary.institution.destroy');

        Route::get('escola/{institution}/data', [InstitutionDataController::class, 'index'])->name('secretary.institution.data.index');
        Route::get('escola/{institution}/consumo', [InstitutionConsumptionController::class, 'index'])->name('secretary.institution.consumption.index');
        Route::get('escola/{institution}/consumption/fetch', [InstitutionConsumptionController::class, 'fetch'])->name('secretary.institution.consumption.fetch');
        Route::get('escola/{institution}/estoque', [InstitutionFoodRecordController::class, 'index'])->name('secretary.institution.foodRecord.index');
        Route::get('escola/{institution}/relatorio', [InstitutionReportController::class, 'create'])->name('secretary.institution.report.create');
        Route::get('escola/{institution}/report/fetch', [InstitutionReportController::class, 'fetch'])->name('secretary.institution.report.fetch');
        Route::get('escola/{institution}/cardapio', [InstitutionMealController::class, 'index'])->name('secretary.institution.meal.index');
        
        
        

        // Funcionários (Usuários)
        Route::get('funcionarios', [SecretaryUserController::class, 'index'])->name('secretary.user.index');
        Route::get('funcionario/cadastrar', [SecretaryUserController::class, 'create'])->name('secretary.user.create');
        Route::post('funcionario/cadastrar', [SecretaryUserController::class, 'store'])->name('secretary.user.store')->middleware('restore:user');
        Route::get('funcionario/{user}/editar', [SecretaryUserController::class, 'edit'])->name('secretary.user.edit');
        Route::put('funcionario/{user}/editar', [SecretaryUserController::class, 'update'])->name('secretary.user.update')->middleware('restore:user');
        Route::delete('funcionario/{user}/excluir', [SecretaryUserController::class, 'destroy'])->name('secretary.user.destroy');
        Route::post('funcionario/{id}/restaurar', [SecretaryUserRestoreController::class, 'store'])->name('secretary.user.restore');

        // Alimentos
        Route::get('alimentos', [SecretaryFoodController::class, 'index'])->name('secretary.food.index');
        Route::get('alimento/cadastrar', [SecretaryFoodController::class, 'create'])->name('secretary.food.create');
        Route::post('alimento/cadastrar', [SecretaryFoodController::class, 'store'])->name('secretary.food.store')->middleware('restore:food');
        Route::get('alimento/{food}/editar', [SecretaryFoodController::class, 'edit'])->name('secretary.food.edit');
        Route::put('alimento/{food}/editar', [SecretaryFoodController::class, 'update'])->name('secretary.food.update')->middleware('restore:food');
        Route::delete('alimento/{food}/excluir', [SecretaryFoodController::class, 'destroy'])->name('secretary.food.destroy');
        Route::post('alimento/{id}/restaurar', [SecretaryFoodRestoreController::class, 'store'])->name('secretary.food.restore');
    });
    
});