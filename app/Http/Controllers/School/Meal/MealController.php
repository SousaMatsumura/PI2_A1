<?php

namespace App\Http\Controllers\School\Meal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Exception;
use Carbon\Carbon;

class MealController extends Controller
{
    
    public function index(Request $request)
    {
        return view('school.meal.index');
    }

    
    public function store(Request $request)
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->meal['created_at']);

        foreach ($request->meal as $mealId => $value) {

            DB::beginTransaction();

            try {

                Auth::user()->institution->meal()->create([
                    'created_at' => $createdAt,
                    'meal_id' => $mealId,
                    'mealtime' => $value['mealtime'],
                    'amount' => $value['amount'],
                    'repeat' => $value['repeat'],
                    'name' => $value['name']
                ]);

                DB::commit();

            } catch (Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!' . $exception->getMessage());
            }
        }

        return $this->redirectBackWithSuccessAlert('Cardápio cadastrado com sucesso!');
    }
}
