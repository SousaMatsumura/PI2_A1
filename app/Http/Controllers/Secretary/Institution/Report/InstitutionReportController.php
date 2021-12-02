<?php

namespace App\Http\Controllers\Secretary\Institution\Report;

use App\Http\Controllers\Controller;
use App\Models\{FoodRecord, Institution};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstitutionReportController extends Controller
{
    public function index(Institution $institution, Request $request)
    {
        
        
        $foodRecords = DB::select('select foods.name as name, foods.unit as unit,'
            .' food_records.amount as amount, DATE_FORMAT(food_records.created_at, "%d-%m-%Y") as created_at'
            .' from food_records, foods where foods.id = food_records.food_id AND'
            .' food_records.institution_id = '.$institution->id
            .' order by food_records.created_at, food_records.amount DESC');
        
        $consumptions = DB::select('select foods.name as name, foods.unit as unit,'
            .' consumptions.amount_consumed as amount,'
            .' DATE_FORMAT(consumptions.created_at, "%d-%m-%Y") as created_at'
            .' from consumptions, foods where foods.id = consumptions.food_id AND'
            .' consumptions.institution_id = '.$institution->id
            .' order by consumptions.created_at, consumptions.amount_consumed DESC');
            
            $meals = DB::select('select meal.mealtime as time, meal.name as name,'
                .' meal.amount as amount, meal.`repeat` as `repeat`,'
                .' DATE_FORMAT(meal.created_at, "%d-%m-%Y") as created_at'
                .' from meal where meal.institution_id = '.$institution->id
                .' order by meal.created_at, meal.mealtime, meal.amount DESC');
            

            /*for($i = 0; $i < count($foodRecords); $i++){
                for($j = 0; $j < count($foodRecords); $j++){
                    //return $foodRecords[$i]->created_at; //== $consumptions[$j]->created_at;
                    
                    if( date('d-m-Y',strtotime($foodRecords[$i]->created_at)) == date('d-m-Y',strtotime($consumptions[$j]->created_at))){
                        return $foodRecords[$i]->created_at."and".$consumptions[$j]->created_at;
                    };
                }
            } */
        
        return view('secretary.institutions.report.index', [
            'foodRecords' => $foodRecords,
            'consumptions' => $consumptions,
            'meals' => $meals,
            'institution' => $institution,
            'search' => isset($request->search) ? $request->search : '',
        ]);

        /* $datas = DB::select('select foods.name as name, foods.unit as unit,'
        .' food_records.amount as food_records_amount, DATE_FORMAT(food_records.created_at, "%d-%m-%Y")'
        .' as food_records_date, consumptions.amount_consumed as consumptions_amount,'
        .' DATE_FORMAT(consumptions.created_at, "%d-%m-%Y") as consumptions_date'
        .' from consumptions, food_records, foods where foods.id = food_records.food_id AND'
        .' food_records.institution_id = '.$institution->id.' AND foods.id = consumptions.food_id AND'
        .' consumptions.institution_id = '.$institution->id
        .' order by food_records.created_at, consumptions.created_at, food_records.amount DESC, consumptions.amount DESC');

        return view('secretary.institutions.report.index', [
            'datas' => $datas,
            'institution' => $institution,
            'search' => isset($request->search) ? $request->search : '',
        ]); */
    }
}
