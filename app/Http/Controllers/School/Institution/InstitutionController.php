<?php

namespace App\Http\Controllers\School\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Institution;
use App\Http\Requests\School\Institution\InstitutionRequest;
use Auth;
use DB;

class InstitutionController extends Controller
{
    public function edit()
    {
        $institution = Auth::user()->institution->load('address');

        return view('school.institution.edit', compact('institution'));
    }

    public function update(InstitutionRequest $request)
    {
        $institution = Auth::user()->institution;

        DB::beginTransaction();

        try {

            $institution->fill($request->institution);
            $institution->address->fill($request->address)->save();
            $institution->save();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());
        }


        return $this->redirectBackWithSuccessAlert('O cadastro da escola foi atualizado com sucesso!');
    }
}
