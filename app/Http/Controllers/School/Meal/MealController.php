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
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->meal['created_at']);
        
        foreach($request->meals as $mealtime => $data) {
            
            // dd($mealTime);

            DB::beginTransaction();

            try {
                
                Auth::user()->institution->meals()->create([
                    'created_at' => $createdAt,
                    'mealtime' => $mealtime,
                    'name' => $data['name'],
                    'amount' => $data['amount'],
                    'repet' => $data['repeat']
                ]);

                DB::commit();

            } catch(Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!' . $exception->getMessage());
            }
        }

        return $this->redirectBackWithSuccessAlert('Cardápio do dia '.$request->meal['created_at'].' cadastrado com sucesso!');

        
    }
}
