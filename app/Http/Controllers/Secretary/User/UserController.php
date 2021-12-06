<?php

namespace App\Http\Controllers\Secretary\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Secretary\User\{StoreRequest, UpdateRequest};
use App\Models\{User, Institution};
use DB;
use Exception;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $users = User::with('institution');

        if($request->has('pesquisa')) {
            $users->where('name', 'like', '%'.$request->pesquisa.'%')
            ->orWhereHas('institution', function($institution) use ($request) {
                $institution->where('name', 'like', '%'.$request->pesquisa.'%');
            });
        }

        $users = $users->paginate();

        return view('secretary.user.index', compact('users'));
    }

    public function create()
    {
        $institutions = Institution::orderBy('type')->orderBy('name')->get();

        return view('secretary.user.create', compact('institutions'));
    }

    public function store(StoreRequest $request)
    {

        DB::beginTransaction();

        try {

            $user = User::create($request->user);

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());
        }


        return $this->redirectRouteWithAlert('success', 'secretary.user.index', 'O funcionário '.$user->name.' foi cadastrado com sucesso!');

    }

    public function edit(User $user)
    {
        $institutions = Institution::orderBy('type')->orderBy('name')->get();

        return view('secretary.user.edit', compact('user', 'institutions'));
    }

    public function update(UpdateRequest $request, User $user)
    {

        DB::beginTransaction();

        try {

            $user->fill($request->user);
            $user->save();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());
        }


        return $this->redirectRouteWithAlert('success', 'secretary.user.index', 'O cadastro do funcionário '.$user->name.' foi atualizado com sucesso!');

    }

    public function destroy(User $user)
    {
        DB::beginTransaction();

        try {

            $user->delete();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            return $this->redirectBackWithDangerAlert('Não foi possível concluir a operação!'.$exception->getMessage());
        }


        return $this->redirectRouteWithAlert('success', 'secretary.user.index', 'O cadastro do funcionário '.$user->name.' foi excluído com sucesso!');
    }
}
