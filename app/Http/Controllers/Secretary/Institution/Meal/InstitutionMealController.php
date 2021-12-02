<?php

namespace App\Http\Controllers\Secretary\Institution\Meal;

use App\Http\Controllers\Controller;
use App\Models\{Institution};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InstitutionMealController extends Controller
{
    public function index(Institution $institution, Request $request)
    {
        $meals = DB::select('select meal.mealtime as time, meal.name as name,'
        .' meal.amount as amount, meal.`repeat` as `repeat`,'
        .' DATE_FORMAT(meal.created_at, "%d-%m-%Y") as created_at'
        .' from meal where meal.institution_id = '.$institution->id
        .' order by meal.created_at, meal.mealtime, meal.amount DESC');
        
        return view('secretary.institutions.meal.index', [
            'meals' => $meals,
            'institution' => $institution,
            'testDate' => isset($request->testDate) ? $request->testDate : '',
            'beginDate' => isset($request->beginDate) ? $request->beginDate : '',
            'endDate' => isset($request->endDate) ? $request->endDate : '',
            'search' => isset($request->search) ? $request->search : '',
        ]);
    }
}