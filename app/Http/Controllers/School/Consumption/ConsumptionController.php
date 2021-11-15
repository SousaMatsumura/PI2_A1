<?php

namespace App\Http\Controllers\School\Consumption;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Exception;
use Carbon\Carbon;
use App\Http\Requests\School\Consumption\{
    StoreRequest, 
    UpdateRequest
};

class ConsumptionController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            if($request->has('created_at')) {
                $createdAt = Carbon::createFromFormat('d/m/Y', $request->created_at);

                return [
                    'consumptions' => Auth::user()->institution->consumptions()->groupByFood()->whereDate('consumptions.created_at', $createdAt)->get(),
                    'route' => route('school.consumption.update')
                ];
            }
        }
    }

    public function create(Request $request)
    {
        $foodRecords = Auth::user()->institution->foodRecords()->groupByFood();

        if($request->has('pesquisa')) {
            $foodRecords->where('foods.name', 'like', '%'.$request->pesquisa.'%');
        }

        $foodRecords = $foodRecords->get();
        
        session()->flashInput($request->input());

        return view('school.consumption.create', compact('foodRecords'));
    }

    public function store(StoreRequest $request)
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->consumption['created_at']);
        
        foreach($request->foods as $foodId => $value) {
            
            DB::beginTransaction();

            try {
                
                Auth::user()->institution->consumptions()->create([
                    'created_at' => $createdAt,
                    'food_id' => $foodId,
                    'amount_consumed' => $value['amount_consumed'] ?? 0
                ]);

                DB::commit();

            } catch(Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());

            }
            

        }
        
        return $this->redirectBackWithSuccessAlert('Consumo diário do dia '.$request->consumption['created_at'].' foi cadastrado com sucesso!');

    }

    public function update(UpdateRequest $request)
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->consumption['created_at']);
        
        foreach($request->foods as $foodId => $value) {
            
            DB::beginTransaction();

            try {
                
                $consumption = Auth::user()->institution->consumptions()
                ->whereDate('created_at', $createdAt)
                ->where('food_id', $foodId)
                ->firstOrFail();

                $consumption->amount_consumed = $value['amount_consumed'] ?? 0;

                $consumption->save();

                DB::commit();

            } catch(Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());

            }
            

        }
        
        return $this->redirectBackWithSuccessAlert('Consumo diário do dia '.$request->consumption['created_at'].' foi atualizado com sucesso!');
    }
}
