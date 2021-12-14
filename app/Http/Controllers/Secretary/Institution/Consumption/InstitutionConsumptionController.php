<?php

namespace App\Http\Controllers\Secretary\Institution\Consumption;

use App\Http\Controllers\Controller;
use App\Models\{Consumption, Institution};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class InstitutionConsumptionController extends Controller
{
    public function index(Institution $institution, Request $request)
    {
        
        if(!isset($request->consumptionCreatedAt)){
            $request->consumptionCreatedAt = Carbon::now()->format('d/m/Y');
        }

        /*$consumptions = DB::select('select foods.name as name, foods.unit as unit,'
            .' consumptions.amount_consumed as amount from consumptions, foods where'
            .' foods.id = consumptions.food_id AND consumptions.institution_id = '.$institution->id
            .' AND Date(consumptions.created_at) = CURDATE()'
            .' order by foods.name, consumptions.amount_consumed'); */

        $consumptions = DB::select('select foods.name as name, foods.unit as unit,'
        .' consumptions.amount_consumed as amount,'
        .' DATE_FORMAT(consumptions.created_at, "%d/%m/%Y") as created_at'
        .' from consumptions, foods where foods.id = consumptions.food_id AND'
        .' consumptions.institution_id = '.$institution->id
        .' AND Date(consumptions.created_at) = "'
        .Carbon::createFromFormat('d/m/Y', $request->consumptionCreatedAt)->format('Y-m-d')
        .'" order by consumptions.created_at, consumptions.amount_consumed DESC');

        
        
        return view('secretary.institutions.consumption.index', [
            'consumptions' => $consumptions,
            'institution' => $institution,
            'search' => isset($request->search) ? $request->search : '',
            'consumptionCreatedAt' => isset($request->consumptionCreatedAt) ? $request->consumptionCreatedAt : '',
        ]);
    }

    public function fetch(Institution $institution){
        // $students = Student::all();
        $consumptions = DB::select('select foods.name as name, foods.unit as unit,'
        .' consumptions.amount_consumed as amount,'
        .' DATE_FORMAT(consumptions.created_at, "%d/%m/%Y") as created_at'
        .' from consumptions, foods where foods.id = consumptions.food_id AND'
        .' consumptions.institution_id = '.$institution->id
        .' order by consumptions.created_at, consumptions.amount_consumed DESC');
        
        return response()->json([
            'consumptions' => $consumptions,
            'institution' => $institution,
        ]);
    }
}
