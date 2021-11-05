<?php

namespace App\Http\Controllers\School\FoodRecord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;

class FoodRecordController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            return datatables()->of(
                auth()->user()->institution->foodRecords()->groupByFood()
            )->toJson();
        }

        return view('school.food_record.index');
    }
}
