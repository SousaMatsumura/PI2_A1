<?php

namespace App\Http\Controllers\Secretary\Institution\Consumption;

use App\Http\Controllers\Controller;
use App\Models\{Institution, Food};
use Illuminate\Http\Request;
use Carbon\Carbon;

class InstitutionConsumptionController extends Controller
{
    public function index(Institution $institution, Request $request)
    {
        if($request->ajax()) {
            if($request->has('consumption.created_at')) {

                $createdAt = Carbon::createFromFormat('d/m/Y', $request->consumption['created_at']);

                return $institution->consumptions()->whereDate('created_at', $createdAt)->get();
            }
        }

        $foodRecords = Food::all();

        return view('secretary.institutions.consumption.index', compact('institution', 'foodRecords'));
    }
}
