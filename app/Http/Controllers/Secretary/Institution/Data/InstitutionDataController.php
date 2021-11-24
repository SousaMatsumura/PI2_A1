<?php

namespace App\Http\Controllers\Secretary\Institution\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Institution, Address};

class InstitutionDataController extends Controller
{
    public function index(Institution $institution, Request $request)
    {
        return view('secretary.institutions.data.index', [
            'institution' => $institution
        ]);
    }
}
