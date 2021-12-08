<?php

namespace App\Http\Controllers\Secretary\Food;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Secretary\Food\{StoreRequest, UpdateRequest};
use App\Models\Food;
use DB;
use Exception;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $foods = Food::query();

        if($request->has('pesquisa')) {
            $foods->where('name', 'like', '%'.$request->pesquisa.'%');
        }

        $foods = $foods->paginate();

        return view('secretary.food.index', compact('foods'));
    }

    public function create()
    {
        return view('secretary.food.create');
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try {

            $food = Food::create($request->food);

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());
        }


        return $this->redirectRouteWithAlert('success', 'secretary.food.index', 'O alimento '.$food->name.' foi cadastrado com sucesso!');
    }

    public function edit(Food $food)
    {
        if($food->hasRecords()) {

            $insitutionNames = $food->getRecordsInstitutionNames();

            $this->setFlashList($insitutionNames);
            return $this->redirectRouteWithAlert('info', 'secretary.food.index', 'O alimento '.$food->name.' não pode ser alterado ou excluído.<br>Existem registros no estoque das escolas:');
        }

        return view('secretary.food.edit', compact('food'));
    }

    public function update(UpdateRequest $request, Food $food)
    {

        DB::beginTransaction();

        try {

            $food->fill($request->food);
            $food->save();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());
        }


        return $this->redirectRouteWithAlert('success', 'secretary.food.index', 'O alimento '.$food->name.' foi atualizado com sucesso!');

    }

    public function destroy(Food $food)
    {
        if($food->hasRecords()) {

            $insitutionNames = $food->getRecordsInstitutionNames();

            $this->setFlashList($insitutionNames);
            return $this->redirectRouteWithAlert('info', 'secretary.food.index', 'O alimento '.$food->name.' não pode ser alterado ou excluído.<br>Existem registros no estoque das escolas:');
        }

        DB::beginTransaction();

        try {

            $food->delete();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());
        }


        return $this->redirectRouteWithAlert('success', 'secretary.food.index', 'O alimento '.$food->name.' foi excluído com sucesso!');
    }
}
