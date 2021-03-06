<?php

namespace App\Http\Controllers\School\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\School\Menu\MenuRequest;
use DB;
use Auth;
use Carbon\Carbon;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            if($request->has('created_at')) {
                $createdAt = Carbon::createFromFormat('d/m/Y', $request->created_at);

                return [
                    'menus' => Auth::user()->institution->menus()->whereDate('created_at', $createdAt)->get(),
                    'route' => route('school.menu.update')
                ];
            }
        }
    }

    public function create()
    {
        return view('school.menu.create');
    }

    public function store(MenuRequest $request)
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->menu['created_at']);
        
        foreach($request->meals as $mealtime => $data) {

            DB::beginTransaction();

            try {
                
                Auth::user()->institution->menus()->create([
                    'created_at' => $createdAt,
                    'mealtime' => $mealtime,
                    'description' => $data['description'],
                    'amount' => $data['amount'],
                    'repeat' => $data['repeat']
                ]);

                DB::commit();

            } catch(Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());

            }
            

        }
        
        return $this->redirectBackWithSuccessAlert('Cardápio do dia '.$request->menu['created_at'].' foi cadastrado com sucesso!');
    }

    public function update(MenuRequest $request)
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $request->menu['created_at']);
        
        foreach($request->meals as $mealtime => $data) {
            
            DB::beginTransaction();

            try {
                
                $menu = Auth::user()->institution->menus()
                ->whereDate('created_at', $createdAt)
                ->where('mealtime', $mealtime)
                ->firstOrFail();

                $menu->description = $data['description'];
                $menu->amount = $data['amount'];
                $menu->repeat = $data['repeat'];

                $menu->save();

                DB::commit();

            } catch(Exception $exception) {

                DB::rollback();

                return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());

            }
            

        }
        
        return $this->redirectBackWithSuccessAlert('Cardápio do dia '.$request->menu['created_at'].' foi atualizado com sucesso!');
    }
}
