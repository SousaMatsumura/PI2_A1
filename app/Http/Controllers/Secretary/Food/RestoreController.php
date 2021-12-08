<?php

namespace App\Http\Controllers\Secretary\Food;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use DB;

class RestoreController extends Controller
{
    public function store($id)
    {
        $food = Food::onlyTrashed()->where('id', $id)->first();

        DB::beginTransaction();

        try {

            $food->restore();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());
        }


        return $this->redirectRouteWithAlert('success', 'secretary.food.index', 'O alimento '.$food->name.' foi restaurado com sucesso!');
    }
}
