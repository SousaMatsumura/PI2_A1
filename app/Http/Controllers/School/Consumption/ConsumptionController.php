<?php

namespace App\Http\Controllers\School\Consumption;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Exception;
use Carbon\Carbon;
use App\Http\Requests\School\Consumption\StoreRequest;

class ConsumptionController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            if($request->has('created_at')) {
                $createdAt = Carbon::createFromFormat('d/m/Y', $request->created_at);
             
                return Auth::user()->school->consumptions()->whereDate('created_at', $createdAt)->get();
            }
        }
    }

    public function create()
    {
        $foodRecords = Auth::user()->institution->foodRecords()->groupByFood()->get();
        
        return view('school.consumption.create', compact('foodRecords'));
    }

    public function store(StoreRequest $request)
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->food_record['created_at']);

        foreach($request->foods as $foodId => $value) {
            
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

        return $this->redirectBackWithSuccessAlert('O consumo do dia '.$request->food_record['created_at'].' foi cadastrado com sucesso!');

    }
}
