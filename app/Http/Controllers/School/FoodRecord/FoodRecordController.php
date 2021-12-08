<?php

namespace App\Http\Controllers\School\FoodRecord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Food;

class FoodRecordController extends Controller
{
    public function index(Request $request)
    {
        // $foodRecords = Auth::user()->institution->foodRecords()->groupByFood();

        $foodRecords = Food::withAmountSum(Auth::user()->institution_id);

        if($request->has('pesquisa')) {
            $foodRecords->where('foods.name', 'like', '%'.$request->pesquisa.'%');
        }

        $foodRecords = $foodRecords->paginate(10);

        return view('school.food_record.index', compact('foodRecords'));
    }
}