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

            $foodRecordsExists = FoodRecord::whereDate('created_at', $createdAt)
            ->where('institution_id', $request->institution_id)
            ->exists();

            $foodRecords = Food::getByInstitution($request->institution_id, $createdAt);

            $data = [];
            $data['foodRecords'] = $foodRecords;

            if($foodRecordsExists) {
                $data['route'] = route('secretary.school.food_record.update', $request->institution_id);
            }

            return $data;
            
        }
    
    }

    public function create(Institution $institution)
    {
        if($institution->type === 'SCHOOL') {

            $foods = Food::getByInstitution($institution->id);

            return view('secretary.school.food_record.create', compact('institution', 'foods'));    
        }

        return $this->redirectRouteWithAlert('danger', 'secretary.institution.index', 'Não é possível acessar essa opção.');
        
    }

    public function store(FoodRecordRequest $request, $institutionId)
    {   
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
                ->first();

                if($foodRecord) {
                    
                    $foodRecord->amount = $value['amount'] ?? 0;
                    $foodRecord->save();

                } else {

                    FoodRecord::create([
                        'amount' => $value['amount'] ?? 0,
                        'food_id' => $foodId,
                        'institution_id' => $institutionId,
                        'created_at' => $createdAt
                    ]);

                }

                DB::commit();


            } catch(Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());

            }

        }
        
        return $this->redirectBackWithSuccessAlert('Entrada de alimentos do dia '.$request->food_record['created_at'].' foi atualizada com sucesso!');
    }
}
