<?php

namespace App\Http\Controllers\Secretary\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Exception;

class RestoreController extends Controller
{
    public function store($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();

        DB::beginTransaction();

        try {

            $user->restore();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());
        }


        return $this->redirectRouteWithAlert('success', 'secretary.user.index', 'O cadastro do funcionário '.$user->name.' foi restaurado com sucesso!');
    }
}
