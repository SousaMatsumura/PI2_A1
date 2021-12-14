<?php

namespace App\Http\Controllers\Secretary\Institution\Meal;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InstitutionMealController extends Controller
{
    public function index(Institution $institution, Request $request)
    {   

        if($request->ajax()) {
        
            if($request->has('menu.created_at')) {
                $createdAt = Carbon::createFromFormat('d/m/Y', $request->menu['created_at']);
                
                return $institution->menus()->whereDate('created_at', $createdAt)->get();
            }
            
        }

        return view('secretary.institutions.meal.index', compact('institution'));
    }
}