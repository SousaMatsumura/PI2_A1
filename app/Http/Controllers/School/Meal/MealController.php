<?php

namespace App\Http\Controllers\School\Meal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Exception;
use Carbon\Carbon;
use App\Http\Requests\School\Meal\MealRequest;

class MealController extends Controller
{
    
    public function index(Request $request)
    {
        return view('school.meal.index');
    }

    public function create(Request $request)
    {
        return view('school.meal.create');
    }

    
    public function store(MealRequest $request)
    {
        return $request->all();
        // $createdAt = Carbon::createFromFormat('d/m/Y', $request->meal['createdAt']);

        // foreach ($request->meal as $mealId => $value) {

        //     DB::beginTransaction();

        //     try {

        //         Auth::user()->institution->meal()->create([
        //             'createdAt' => $createdAt,
        //             'meal_id' => $mealId,
        //             'mealtime' => $value['mealtime'],
        //             'amount' => $value['amount'],
        //             'repeat' => $value['repeat'],
        //             'name' => $value['name']
        //         ]);

        //         DB::commit();

        //     } catch (Exception $exception) {

        //         DB::rollback();

        //         return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!' . $exception->getMessage());
        //     }
        // }

        // return $this->redirectBackWithSuccessAlert('Cardápio cadastrado com sucesso!');

        
    }
}
