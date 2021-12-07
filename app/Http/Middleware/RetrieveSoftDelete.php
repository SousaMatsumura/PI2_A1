<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RetrieveSoftDelete
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

        switch($model) {
            case 'food':
                $query = $this->buildFoodQuery($query, $request);
                break;
        }

        $trashedModel = $query->first();

        if($trashedModel) {
            return back()->with('trashed', $trashedModel)->withInput();
        }

        return $next($request);
    }

    private function buildFoodQuery($query, $request) 
    {
        return $query->where('name', $request->food['name'])->where('unit', $request->food['unit']);
    }
    
}
