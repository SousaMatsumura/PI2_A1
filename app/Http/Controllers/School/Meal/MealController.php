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
        if($request->ajax()) {
            if($request->has('created_at')) {
                $createdAt = Carbon::createFromFormat('d/m/Y', $request->created_at);

                return [
                    'meals' => Auth::user()->institution->meals()->whereDate('created_at', $createdAt)->get(),
                    'route' => route('school.meal.update')
                ];
            }
        }
    }

    public function update(MealRequest $request) {

        $createdAt = Carbon::createFromFormat('d/m/Y', $request->meal['created_at']);
        
        foreach($request->meals as $mealtime => $data) {
            
            DB::beginTransaction();

            try {
                
                $meal = Auth::user()->institution->meal()
                ->whereDate('created_at', $createdAt)
                ->where('mealtime', $mealtime)
                ->firstOrFail();

                $menu->name = $data['name'];
                $menu->amount = $data['amount'];
                $menu->repeat = $data['repeat'];

                $menu->save();

                DB::commit();

            } catch(Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());

            }
            

        }
        
        return $this->redirectBackWithSuccessAlert('Cardápio do dia '.$request->meal['created_at'].' foi atualizado com sucesso!');

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
