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
        $inventoryItems = Auth::user()->school->inventories;
        
        return view('school.consumption.create', compact('inventoryItems'));
    }

    public function store(StoreRequest $request)
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->inventory['created_at']);

        foreach($request->foods as $foodId => $value) {
            
            DB::beginTransaction();

            try {

                Auth::user()->school->consumptions()->create([
                    'created_at' => $createdAt,
                    'food_id' => $foodId,
                    'quantity' => $value['quantity']
                ]);

                DB::commit();

            } catch(Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!');

            }
            

        }

        return $this->redirectBackWithSuccessAlert('O consumo do dia '.$request->inventory['created_at'].' foi cadastrado com sucesso!');

    }
}
