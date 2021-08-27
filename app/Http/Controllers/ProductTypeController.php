<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductTypeController extends Controller
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
        $objects = ProductType::orderBy('name')->paginate(20);
        return view('product_types.index',compact('objects'));
    }


    public function create()
    {
        return view('product_types.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = new ProductType();
        $object->name = $request->name;
        $object->save();

        return redirect('product_types')->with('success','Creado correctamente.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $object = ProductType::findOrFail($id);
        return view('product_types.edit',compact('object'));
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = ProductType::findOrFail($id);
        $object->name = $request->name;
        $object->save();

        return redirect('product_types')->with('success','Editado correctamente.');
    }

   
    public function destroy($id)
    {
        ProductType::destroy($id);
        return redirect('product_types')->with('success','Eliminado correctamente.');
    }

   
}
