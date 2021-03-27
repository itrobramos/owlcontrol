<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkRoleRoutePermission($userSession){
        try {
            $route = \Route::currentRouteName();
            $user = User::find(Auth::user()->id); 
            $hasPermission = $user->hasPermissionTo($route);
            // dd($hasPermission);

            return $hasPermission;
        } catch (\Throwable $th) {
            return false;
        }
       
    }
}
