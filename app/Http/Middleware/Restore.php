<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Restore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $model)
    {
        $modelClassName = '\App\Models\\'.ucfirst($model);

        $query = app($modelClassName)->onlyTrashed();

        $trashedModel = null;
        switch($model) {
            case 'food':
                $trashedModel = $this->getTrashedFood($query, $request);
                // $query = $this->buildFoodQuery($query, $request);
                break;

            case 'user':
                $trashedModel = $this->getTrashedUser($query, $request);
                $query = $this->buildUserQuery($query, $request);
                break;
        }

        // $trashedModel = $query->first();

        if($trashedModel) {
            return back()->with('trashed', $trashedModel)->withInput();
        }

        return $next($request);
    }

    private function getTrashedFood($query, $request)
    {
        return $query->where('name', $request->food['name'])->where('unit', $request->food['unit'])->first();
    }

    private function getTrashedUser($query, $request)
    {
        $query = $query->with('institution');
        
        $user = $query->where('username', $request->user['username'])->first();

        if($user) {
            return $user;
        }

        $user = $query->where('email', $request->user['email'])->first();

        if($user) return $user;
    }

    private function buildFoodQuery($query, $request) 
    {
        return $query->where('name', $request->food['name'])->where('unit', $request->food['unit']);
    }

    private function buildUserQuery($query, $request)
    {
        return $query->with('institution')->where('username', $request->user['username'])->orWhere('email', $request->user['email']);
    }
    
}
