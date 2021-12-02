<?php

namespace App\Http\Controllers\Secretary\Institution\Consumption;

use App\Http\Controllers\Controller;
use App\Models\{Consumption, Institution};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstitutionConsumptionController extends Controller
{
    public function index(Institution $institution, Request $request)
    {
        /*$consumptions = Consumption::query()
            ->join('foods', 'foods.id', '=', 'consumptions.food_id')
            ->where('consumptions.institution_id', '=', $institution->id)
            ->orderBy('foods.name')->get(); */
        
        $consumptions = DB::select('select foods.name as name, foods.unit as unit,'
            .' consumptions.amount_consumed as amount from consumptions, foods where'
            .' foods.id = consumptions.food_id AND consumptions.institution_id = '.$institution->id
            .' order by foods.name, consumptions.amount_consumed');

        
        
        /* if(isset($request->search) && $request->search !== ''){
            foreach($consumptions as &$consumption){
                if(!str_contains($consumption->name, $request->search)){
                    unset($consumption);
                    
                }
            }
        } */
        
        return view('secretary.institutions.consumption.index', [
            'consumptions' => $consumptions,
            'institution' => $institution,
            'search' => isset($request->search) ? $request->search : '',
        ]);
        //'consumptions' => $consumptions->paginate(5)
    }
}
