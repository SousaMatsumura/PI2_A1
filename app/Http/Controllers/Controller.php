<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $icons = [
        'success' => 'check-circle',
        'danger' => 'times-circle',
        'warning' => 'exclamation-circle',
        'info' => 'info-circle'
    ];

    public function redirectBackWithSuccessAlert($message) 
    {
        return $this->redirectBackWithAlert('success', $message);
    }

    public function redirectBackWithDangerAlert($message) 
    {
        return $this->redirectBackWithAlert('danger', $message);
    }

    public function redirectBackWithWarningAlert($message) 
    {
        return $this->redirectBackWithAlert('warning', $message);
    }

    public function redirectBackWithInfoAlert($message) 
    {
        return $this->redirectBackWithAlert('info', $message);
    }

    public function redirectRouteWithAlert($type, $route, $message)
    {
        return redirect()->route($route)->with([
            'alert' => [
                'icon' => $this->icons[$type],
                'type' => $type,
                'message' => $message
            ]
        ])
        ->withInput()
        ->with(request()->all());
    }

    public function setFlashList($elements)
    {
        session()->flash('list', [
            'elements' => $elements
        ]);
    }

    private function redirectBackWithAlert($type, $message)
    {
        return back()->with([
            'alert' => [
                'icon' => $this->icons[$type],
                'type' => $type,
                'message' => $message
            ]
        ])
        ->withInput();
    }
}
