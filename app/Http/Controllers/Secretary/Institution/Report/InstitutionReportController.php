<?php

namespace App\Http\Controllers\Secretary\Institution\Report;

use App\Http\Controllers\Controller;
use App\Models\{FoodRecord, Institution};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InstitutionReportController extends Controller
{

    public function create(Institution $institution, Request $request)
    {
        $data = [];
        $data['institution'] = $institution;

        if($request->has('inicio') && $request->has('final')) {

            $begin = Carbon::createFromFormat('d/m/Y', $request->inicio);
            $end = Carbon::createFromFormat('d/m/Y', $request->final);

            $data['foodRecords'] = $institution->foodRecords()->whereBetween('created_at', [$begin, $end])->orderBy('created_at')->get();
            $data['consumptions'] = $institution->consumptions()->whereBetween('created_at', [$begin, $end])->orderBy('created_at')->get();
            $data['menus'] = $institution->menus()->whereBetween('created_at', [$begin, $end])->orderBy('created_at')->get();

        }
        
        return view('secretary.institutions.report.create', $data);
    }

    public function store()
    {

    }

    public function index(Institution $institution, Request $request)
    {
        if(!isset($request->begin)){ $request->begin = Carbon::now()->format('d/m/Y');}
        if(!isset($request->end)){ $request->end = Carbon::now()->format('d/m/Y');}
        
        $foodRecords = DB::select('select foods.name as name, foods.unit as unit,'
            .' food_records.amount as amount, DATE_FORMAT(food_records.created_at, "%d/%m/%Y") as created_at'
            .' from food_records, foods where foods.id = food_records.food_id AND'
            .' food_records.institution_id = '.$institution->id
            .' AND Date(food_records.created_at) >= "'
            .Carbon::createFromFormat('d/m/Y', $request->begin)->format('Y-m-d')
            .'" AND Date(food_records.created_at) <= "'
            .Carbon::createFromFormat('d/m/Y', $request->end)->format('Y-m-d')
            .'" order by food_records.created_at, food_records.amount DESC');

        $consumptions = DB::select('select foods.name as name, foods.unit as unit,'
            .' consumptions.amount_consumed as amount,'
            .' DATE_FORMAT(consumptions.created_at, "%d/%m/%Y") as created_at'
            .' from consumptions, foods where foods.id = consumptions.food_id AND'
            .' consumptions.institution_id = '.$institution->id
            .' AND Date(consumptions.created_at) >= "'
            .Carbon::createFromFormat('d/m/Y', $request->begin)->format('Y-m-d')
            .'" AND Date(consumptions.created_at) <= "'
            .Carbon::createFromFormat('d/m/Y', $request->end)->format('Y-m-d')
            .'" order by consumptions.created_at, consumptions.amount_consumed DESC');

        /*
        $meals = DB::select('select meal.mealtime as time, meal.name as name,'
            .' meal.amount as amount, meal.`repeat` as `repeat`,'
            .' DATE_FORMAT(meal.created_at, "%d/%m/%Y") as created_at'
            .' from meal where meal.institution_id = '.$institution->id
            .' AND Date(meal.created_at) >= "'
            .Carbon::createFromFormat('d/m/Y', $request->begin)->format('Y-m-d')
            .'" AND Date(meal.created_at) <= "'
            .Carbon::createFromFormat('d/m/Y', $request->end)->format('Y-m-d')
            .'" order by meal.created_at, meal.mealtime, meal.amount DESC');
            */
            
        $menus = DB::select('select menus.mealtime as time, menus.description as name,'
            .' menus.amount as amount, menus.`repeat` as `repeat`,'
            .' DATE_FORMAT(menus.created_at, "%d/%m/%Y") as created_at'
            .' from menus where menus.institution_id = '.$institution->id
            .' AND Date(menus.created_at) >= "'
            .Carbon::createFromFormat('d/m/Y', $request->begin)->format('Y-m-d')
            .'" AND Date(menus.created_at) <= "'
            .Carbon::createFromFormat('d/m/Y', $request->end)->format('Y-m-d')
            .'" order by menus.created_at, menus.mealtime, menus.amount DESC');

        return view('secretary.institutions.report.index', [
            'foodRecords' => $foodRecords,
            'consumptions' => $consumptions,
            //'meals' => $meals,
            'menus' => $menus,
            'institution' => $institution,
            'search' => isset($request->search) ? $request->search : '',
            'begin' => isset($request->begin) ? $request->begin : '',
            'end' => isset($request->end) ? $request->end : '',
        ]);

    }

    public function fetch(Institution $institution){
        
        $foodRecords = DB::select('select foods.name as name, foods.unit as unit,'
            .' food_records.amount as amount, DATE_FORMAT(food_records.created_at, "%d/%m/%Y") as created_at'
            .' from food_records, foods where foods.id = food_records.food_id AND'
            .' food_records.institution_id = '.$institution->id
            .' order by food_records.created_at, food_records.amount DESC');

        $consumptions = DB::select('select foods.name as name, foods.unit as unit,'
            .' consumptions.amount_consumed as amount,'
            .' DATE_FORMAT(consumptions.created_at, "%d/%m/%Y") as created_at'
            .' from consumptions, foods where foods.id = consumptions.food_id AND'
            .' consumptions.institution_id = '.$institution->id
            .' order by consumptions.created_at, consumptions.amount_consumed DESC');
        
        $menus = DB::select('select menus.mealtime as time, menus.description as name,'
        .' menus.amount as amount, menus.`repeat` as `repeat`,'
        .' DATE_FORMAT(menus.created_at, "%d/%m/%Y") as created_at'
        .' from menus where menus.institution_id = '.$institution->id
        .' order by menus.created_at, menus.mealtime, menus.amount DESC');

        return response()->json([
            'foodRecords' => $foodRecords,
            'consumptions' => $consumptions,
            'menus' => $menus,
            'institution' => $institution,
        ]);
    }
}
