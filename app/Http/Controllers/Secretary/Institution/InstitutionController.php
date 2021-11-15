<?php

namespace App\Http\Controllers\Secretary\Institution;

use App\Http\Controllers\Controller;
use App\Models\{Institution, Address};
use App\Http\Requests\Secretary\Institution\RegisterInstitutionRequest;
use Illuminate\Http\Request;
use Auth;
use DB;
use Exception;
use Carbon\Carbon;

class InstitutionController extends Controller
{
    
    public function index(Request $request)
    {
        $institutions = Institution::query();

        if(isset($request->search) && $request->search !== ''){
            $institutions->where('name', 'like', '%' . $request->search . '%');
        }

        return view('secretary.institutions.index', [
            'institutions' => $institutions->paginate(5),
            'search' => isset($request->search) ? $request->search : '',
        ]);
    }

    public function create()
    {
        return view('secretary.institutions.create');
    }

    public function store(RegisterInstitutionRequest $request){
        $requestData = $request->validated();
        
        $requestData['institution']['type'] = 'SCHOOL';

        DB::beginTransaction();
        try{
            $institution = Institution::create($requestData['institution']);         
            $institution->address()->create($requestData['address']);

            DB::commit();

            return redirect()
                ->route('secretary.institution.create')
                ->with('success', 'Instituição cadastrada com sucesso.');

        }catch(\Exception $exception){
            DB::rollBack();
            return "Mensagem: " . $exception->getMessage();
        };
    }

    public function show(Institution $institution){
        return view('secretary.institutions.show', [
            'institution' => $institution,
            
        ]);
    }

    public function edit(Institution $institution)
    {   
        $address = $institution->address;
        
        return view('secretary.institutions.edit', compact('institution', 'address'));
    }

    public function update(Institution $institution, RegisterInstitutionRequest $request)
    {

        $requestData = $request->validated();
        
        $institution->update($requestData['institution']);
        $address = $institution->address();
        $address->update($requestData['address']);

        return redirect()
            ->route('secretary.institutions.index')
            ->with('success', 'Instituição atualizada com sucesso!');
    }

    public function destroy(Institution $institution)
    {
        
        $institution->address()->delete();
        $institution->delete();

        return redirect()
            ->route('secretary.institution.index')
            ->with('success', 'Instituição deletada com sucesso!');
    }
}
