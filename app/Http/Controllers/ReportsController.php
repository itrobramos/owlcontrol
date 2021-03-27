<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ReportsController extends Controller
{
    public function __construct(){
        // $this->middleware(function ($request, $next) {
        //     $userSession = Auth::user();
        //     if(!$this->checkRoleRoutePermission($userSession)){
        //         return response()->view('errors.error');
        //     }
        //     return $next($request);
        // });
    }
  
    public function index()
    {
        return view('reports.index');
    }

    public function sales()
    {
        $SalesGraph = DB::select("SELECT YEAR(created_at) year, MONTH(created_at) month, SUM(total) total 
        FROM sales
        WHERE clientId = " . Auth::user()->clientId . "
        GROUP BY YEAR(created_at), MONTH(created_at)");

        $data["SalesGraph"] = $SalesGraph;

        return view('reports.sales', $data);
    }

    public function salesDate(Request $request){

        $fechaInicio = $request->FechaInicio;
        $fechaFin = $request->FechaFin;

        $SalesGraph = DB::select("SELECT YEAR(created_at) year, MONTH(created_at) month, SUM(total) total 
        FROM sales
        WHERE clientId = " . Auth::user()->clientId . "
        AND created_at BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'  
        GROUP BY YEAR(created_at), MONTH(created_at)");

        $Parameters = ["FechaInicio" => $fechaInicio, 
                         "FechaFin" => $fechaFin];

        $data["SalesGraph"] = $SalesGraph;
        $data["Parameters"] = $Parameters;

        return view('reports.sales', $data);
    }

       
    public function platforms()
    {
        $SalesGraph = DB::select("SELECT p.name name, p.color, p.logo, SUM(total) total 
        FROM sales s INNER JOIN orders o ON o.id = s.orderId
                     INNER JOIN platforms p ON o.platformId = p.id
        WHERE s.clientId = " . Auth::user()->clientId . "
        GROUP BY p.name, p.color, p.logo
        ORDER BY total DESC");


        $data["SalesGraph"] = $SalesGraph;
    
        return view('reports.platforms', $data);
    }

    public function platformsDate(Request $request){

        $fechaInicio = $request->FechaInicio;
        $fechaFin = $request->FechaFin;

        $SalesGraph = DB::select("SELECT p.name name, p.color, p.logo, SUM(total) total 
        FROM sales s INNER JOIN orders o ON o.id = s.orderId
                     INNER JOIN platforms p ON o.platformId = p.id
        WHERE s.clientId = " . Auth::user()->clientId . "
        AND s.created_at BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'  
        GROUP BY p.name, p.color, p.logo
        ORDER BY total DESC");


        $Parameters = ["FechaInicio" => $fechaInicio, 
                       "FechaFin" => $fechaFin];

        $data["SalesGraph"] = $SalesGraph;
        $data["Parameters"] = $Parameters;
    
        return view('reports.platforms', $data);
    }


    public function categories()
    {
        $SalesGraph = DB::select("SELECT c.name, sum(total) total 
        FROM sales s INNER JOIN orders o ON o.id = s.orderId
                     INNER JOIN orders_detail od ON o.id = od.orderId
                     INNER JOIN products p ON od.productId = p.id
                     INNER JOIN categories c ON p.categoryId = c.id
        WHERE s.clientId = " . Auth::user()->clientId . "
        GROUP BY c.name
        ORDER BY total DESC");


        $data["SalesGraph"] = $SalesGraph;
    
        return view('reports.categories', $data);
    }

    public function categoriesDate(Request $request){

        $fechaInicio = $request->FechaInicio;
        $fechaFin = $request->FechaFin;

        $SalesGraph = DB::select("SELECT c.name, sum(total) total 
        FROM sales s INNER JOIN orders o ON o.id = s.orderId
                     INNER JOIN orders_detail od ON o.id = od.orderId
                     INNER JOIN products p ON od.productId = p.id
                     INNER JOIN categories c ON p.categoryId = c.id
        WHERE s.clientId = " . Auth::user()->clientId . "
        AND s.created_at BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'  
        GROUP BY c.name
        ORDER BY total DESC");

        $Parameters = ["FechaInicio" => $fechaInicio, 
                       "FechaFin" => $fechaFin];

        $data["SalesGraph"] = $SalesGraph;
        $data["Parameters"] = $Parameters;
    
        return view('reports.categories', $data);
    }


    public function products()
    {

        $TopSales = DB::select("SELECT p.name, sum(quantity) quantity, sum(total) total
                                FROM sales s INNER JOIN orders o ON o.id = s.orderId
                                            INNER JOIN orders_detail od ON o.id = od.orderId
                                            INNER JOIN products p ON od.productId = p.id
                                WHERE s.clientId = " . Auth::user()->clientId . "
                                GROUP BY p.name
                                ORDER BY total DESC
                                LIMIT 5");

        $LessSales = DB::select("SELECT p.name, sum(quantity) quantity, sum(total) total
                                FROM sales s INNER JOIN orders o ON o.id = s.orderId
                                            INNER JOIN orders_detail od ON o.id = od.orderId
                                            INNER JOIN products p ON od.productId = p.id
                                WHERE s.clientId = " . Auth::user()->clientId . "
                                GROUP BY p.name
                                ORDER BY total ASC
                                LIMIT 5");

     
        $data["TopSales"] = $TopSales;
        $data["LessSales"] = $LessSales;
    
        return view('reports.products', $data);
    }



    public function productsDate(Request $request)
    {
        
        $fechaInicio = $request->FechaInicio;
        $fechaFin = $request->FechaFin;

        $TopSales = DB::select("SELECT p.name, sum(quantity) quantity, sum(total) total
                                FROM sales s INNER JOIN orders o ON o.id = s.orderId
                                            INNER JOIN orders_detail od ON o.id = od.orderId
                                            INNER JOIN products p ON od.productId = p.id
                                WHERE s.clientId = " . Auth::user()->clientId . "
                                 AND s.created_at BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'  
                                GROUP BY p.name
                                ORDER BY total DESC
                                LIMIT 5");

        $LessSales = DB::select("SELECT p.name, sum(quantity) quantity, sum(total) total
                                FROM sales s INNER JOIN orders o ON o.id = s.orderId
                                            INNER JOIN orders_detail od ON o.id = od.orderId
                                            INNER JOIN products p ON od.productId = p.id
                                WHERE s.clientId = " . Auth::user()->clientId . "
                                 AND s.created_at BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'  
                                GROUP BY p.name
                                ORDER BY total ASC
                                LIMIT 5");

        $Parameters = ["FechaInicio" => $fechaInicio, 
                        "FechaFin" => $fechaFin];
            
        $data["Parameters"] = $Parameters;
        $data["TopSales"] = $TopSales;
        $data["LessSales"] = $LessSales;
    
        return view('reports.products', $data);
    }


   
}
