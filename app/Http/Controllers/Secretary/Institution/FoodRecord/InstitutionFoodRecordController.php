<?php

namespace App\Http\Controllers\Secretary\Institution\FoodRecord;

use App\Http\Controllers\Controller;
use App\Models\{FoodRecord, Institution};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstitutionFoodRecordController extends Controller
{
    public function index(Institution $institution, Request $request)
    {
        /* $consumptions = Consumption::query()
            ->join('foods', 'foods.id', '=', 'consumptions.food_id')
            ->where('consumptions.institution_id', '=', $institution->id)
            ->orderBy('foods.name')->get(); */

        $foodRecords = DB::select('select foods.name as name, foods.unit as unit, food_records.id as id,'
        .' food_records.amount as amount from food_records, foods where'
        .' foods.id = food_records.food_id AND food_records.institution_id = '.$institution->id
        .' order by food_records.amount DESC, foods.name');
        
        return view('secretary.institutions.foodRecord.index', [
            'foodRecords' => $foodRecords,
            'institution' => $institution,
            'search' => isset($request->search) ? $request->search : '',
        ]);
        //'consumptions' => $consumptions->paginate(5)
    }
}
