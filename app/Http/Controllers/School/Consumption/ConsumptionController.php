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
use App\Models\Food;

class ConsumptionController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            if($request->has('created_at')) {
                $createdAt = Carbon::createFromFormat('d/m/Y', $request->created_at);

                $consumptions = Auth::user()->institution->consumptions()->groupByFood()->whereDate('consumptions.created_at', $createdAt)->get();

                $data = [];
                $data['consumptions'] = $consumptions;

                if($consumptions->count() > 0) $data['route'] = route('school.consumption.update');

                return $data;
            }
        }
    }

    public function create(Request $request)
    {
        $foodRecords = Food::getByInstitution(Auth::user()->institution_id);

        return view('school.consumption.create', compact('foodRecords'));
    }

    public function store(StoreRequest $request)
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->consumption['created_at']);
        
        foreach($request->foods as $foodId => $value) {
            
            if($value['amount_consumed']) {

                DB::beginTransaction();

                try {
                    
                    Auth::user()->institution->consumptions()->create([
                        'created_at' => $createdAt,
                        'food_id' => $foodId,
                        'amount_consumed' => $value['amount_consumed']
                    ]);

                    DB::commit();

                } catch(Exception $exception) {

                    DB::rollback();

                    return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());

                }

            }
            
        }
        
        return $this->redirectBackWithSuccessAlert('Consumo diário do dia '.$request->consumption['created_at'].' foi cadastrado com sucesso!');

    }

    public function update(UpdateRequest $request)
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->consumption['created_at']);
        
        foreach($request->foods as $foodId => $value) {
            
            if($value['amount_consumed']) {

                DB::beginTransaction();

                try {

                    $consumption = Auth::user()->institution->consumptions()
                    ->whereDate('created_at', $createdAt)
                    ->where('food_id', $foodId)
                    ->first();

                    if(!$consumption) {
                        
                        Auth::user()->institution->consumptions()->create([
                            'created_at' => $createdAt,
                            'food_id' => $foodId,
                            'amount_consumed' => $value['amount_consumed']
                        ]);

                    } else {
                        
                        $consumption->amount_consumed = $value['amount_consumed'];
                        $consumption->save();

                    }

                    DB::commit();


                } catch(Exception $exception) {

                    DB::rollback();

                    return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());

                }
            }

        }
        
        return $this->redirectBackWithSuccessAlert('Consumo diário do dia '.$request->consumption['created_at'].' foi atualizado com sucesso!');
    }
}
