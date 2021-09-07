<?php

namespace App\Http\Controllers;

use App\Models\ExpiryControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class ReportsController extends Controller
{
    // public function __construct(){
    //     $this->middleware(function ($request, $next) {
    //         $route = \Route::currentRouteName();//actual 
    //         $ignoreRoutes = [
    //             'reports.salesDate',
    //             'reports.platformsDate',
    //             'reports.categoriesDate',
    //             'reports.productsDate',
    //             'reports.accountingDate',
    //         ];

    //         if (!in_array($route,$ignoreRoutes)) {
    //             $userSession = Auth::user();
    //             if(!$this->checkRoleRoutePermission($userSession)){
    //                 return response()->view('errors.error');
    //             }
    //         }
    //         return $next($request);
    //     });
    // }
  
    public function index()
    {
        return view('reports.index');
    }

    public function cashflow()
    {
        $CashFLowGraph = DB::select("SELECT YEAR(created_at) year, MONTH(created_at) month, SUM(totalcost + shipcost) total 
        FROM entries
        GROUP BY YEAR(created_at), MONTH(created_at)");

        $data["CashFLowGraph"] = $CashFLowGraph;
        $data["CashFLowGraph2"] = $CashFLowGraph;

        return view('reports.cashflow', $data);
    }

    public function cashflowDate(Request $request){

        $fechaInicio = $request->FechaInicio;
        $fechaFin = $request->FechaFin;

        $CashFLowGraph = DB::select("SELECT YEAR(created_at) year, MONTH(created_at) month, SUM(totalcost + shipcost) total 
        FROM entries
        WHERE created_at BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'  
        GROUP BY YEAR(created_at), MONTH(created_at)");

        $Parameters = ["FechaInicio" => $fechaInicio, 
                       "FechaFin" => $fechaFin];

        $data["CashFLowGraph"] = $CashFLowGraph;
        $data["CashFLowGraph2"] = $CashFLowGraph;
        $data["Parameters"] = $Parameters;

        return view('reports.cashflow', $data);
    }

    public function expiration()
    {
       
        $expirationData = ExpiryControl::where('available', 1)->whereDate('date', '>', Carbon::now()->subDays(60))->orderBy('date')->paginate(20);
        $data["expirationData"] = $expirationData;

        return view('reports.expiration', $data);
    }
  
}
