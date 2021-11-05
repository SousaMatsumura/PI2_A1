<?php

namespace App\Http\Controllers\School\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            return datatables()->of(auth()->user()->school->inventories()->with(['food']))->toJson();
        }

        return view('school.inventory.index');
    }
}
