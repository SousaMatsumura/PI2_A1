<?php

namespace App\Http\Controllers\Secretary\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Secretary\FoodRecord\FoodRecordRequest;
use App\Models\{Institution, Food, FoodRecord};
use Carbon\Carbon;
use DB;

class FoodRecordController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $createdAt = Carbon::createFromFormat('d/m/Y', $request->created_at);

            $foodRecords = FoodRecord::whereDate('created_at', $createdAt)
            ->where('institution_id', $request->institution_id)
            ->get();

            return [
                'foodRecords' => $foodRecords,
                'route' => route('secretary.school.food_record.update', $request->institution_id)
            ];
        }
    
    }

    public function create(Institution $institution)
    {
        if($institution->type === 'SCHOOL') {

            $foods = Food::getByInstitution($institution->id)->get();

            return view('secretary.school.food_record.create', compact('institution', 'foods'));    
        }

        return redirect()->route('secretary.institution.index');
        
    }

    public function store(FoodRecordRequest $request, $institutionId)
    {   
        // return $request->all();
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->food_record['created_at']);

        foreach($request->foods as $foodId => $value) {
            
            DB::beginTransaction();

            try {
                
                FoodRecord::create([
                    'amount' => $value['amount'] ?? 0,
                    'food_id' => $foodId,
                    'institution_id' => $institutionId,
                    'created_at' => $createdAt
                ]);

                DB::commit();

            } catch(Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());

            }
            

        }
        
        return $this->redirectBackWithSuccessAlert('Entrada de alimentos do dia '.$request->food_record['created_at'].' foi cadastrada com sucesso!');

    }

    public function update(FoodRecordRequest $request, $institutionId)
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->food_record['created_at']);
        
        foreach($request->foods as $foodId => $value) {
            
            DB::beginTransaction();

            try {
                
                $foodRecord = FoodRecord::whereDate('created_at', $createdAt)
                ->where('institution_id', $institutionId)
                ->where('food_id', $foodId)
                ->firstOrFail();

                if($value['amount']) {
                    $foodRecord->amount = $value['amount'];

                    $foodRecord->save();

                    DB::commit();
                }
            

            } catch(Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());

            }
            

        }
        
        return $this->redirectBackWithSuccessAlert('Entrada de alimentos do dia '.$request->food_record['created_at'].' foi atualizada com sucesso!');
    }
}
