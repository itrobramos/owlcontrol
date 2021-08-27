<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SupplierController extends Controller
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
        $suppliers = Supplier::orderBy('name')->paginate(20);
        return view('suppliers.index',compact('suppliers'));
    }


    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('suppliersUploads/images/', $filename);
            $supplier->imageUrl = 'suppliersUploads/images/'.$filename;
        }

        $supplier->save();




        return redirect('suppliers')->with('success','Proveedor creado correctamente.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit',compact('supplier'));
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->name;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('suppliersUploads/images/', $filename);
            $supplier->imageUrl = 'suppliersUploads/images/'.$filename;
        }
        $supplier->save();

        return redirect('suppliers')->with('success','Proveedor editado correctamente.');
    }

   
    public function destroy($id)
    {
        Supplier::destroy($id);
        return redirect('suppliers')->with('success','Proveedor eliminado correctamente.');
    }

   
}
