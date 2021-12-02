<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\School\{
    Dashboard\DashboardController as SchoolDashboardController,
    FoodRecord\FoodRecordController as SchoolFoodRecordControllerController,
    Consumption\ConsumptionController as SchoolConsumptionController,
    Meal\MealController as SchoolMealController
};
use App\Http\Controllers\Secretary\{
    Dashboard\DashboardController as SecretaryDashboardController,
    Institution\InstitutionController,
    Institution\Data\InstitutionDataController,
    Institution\Consumption\InstitutionConsumptionController,
    Institution\FoodRecord\InstitutionFoodRecordController,
    Institution\Report\InstitutionReportController,
    Institution\Meal\InstitutionMealController,
    School\FoodRecordController as SecretarySchoolFoodRecordController
};
use App\Models\Institution;

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
      
        Route::get('cardapio/cadastrar', [SchoolMealController::class, 'index'])->name('school.meal.index');
        Route::post('cardapio/cadastrar', [SchoolMealController::class, 'store'])->name('school.meal.store');

    });

    Route::middleware('institution.type:SECRETARY')->prefix('secretaria')->group(function(){
        Route::get('painel', [SecretaryDashboardController::class, 'index'])->name('secretary.dashboard.index');
        Route::get('instituicao', [InstitutionController::class, 'index'])->name('secretary.institution.index');
        Route::get('instituicao/cadastrar', [InstitutionController::class, 'create'])->name('secretary.institution.create');
        Route::post('instituicao', [InstitutionController::class, 'store'])->name('secretary.institution.store');
        Route::get('{institution}', [InstitutionController::class, 'show'])->name('secretary.institution.show');
        Route::get('{institution}/edit', [InstitutionController::class, 'edit'])->name('secretary.institution.edit');
        Route::put('{instituicao}', [InstitutionController::class, 'update'])->name('secretary.institution.update');
        Route::delete('{institution}', [InstitutionController::class, 'destroy'])->name('secretary.institution.destroy');

        Route::get('{institution}/data', [InstitutionDataController::class, 'index'])->name('secretary.institution.data.index');
        Route::get('{institution}/consumption', [InstitutionConsumptionController::class, 'index'])->name('secretary.institution.consumption.index');
        Route::get('{institution}/foodRecord', [InstitutionFoodRecordController::class, 'index'])->name('secretary.institution.foodRecord.index');
        Route::get('{institution}/report', [InstitutionReportController::class, 'index'])->name('secretary.institution.report.index');
        Route::get('{institution}/meal', [InstitutionMealController::class, 'index'])->name('secretary.institution.meal.index');
        
        Route::get('escola/entrada-alimentos', [SecretarySchoolFoodRecordController::class, 'index'])->name('secretary.school.food_record.index');
        Route::get('escola/{institution}/entrada-alimentos', [SecretarySchoolFoodRecordController::class, 'create'])->name('secretary.school.food_record.create');
        Route::post('escola/{institution}/entrada-alimentos', [SecretarySchoolFoodRecordController::class, 'store'])->name('secretary.school.food_record.store');
        Route::patch('escola/{institution}/entrada-alimentos/atualizar', [SecretarySchoolFoodRecordController::class, 'update'])->name('secretary.school.food_record.update');
    });
    
});



Route::get('teste', function(){
    
    $institution = \App\Models\Institution::find(2);

    $foods = \App\Models\Food::getByInstitution(1)
    ->get();


    return $foods;

});