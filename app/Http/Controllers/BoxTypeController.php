<?php

namespace App\Http\Controllers;

use App\Models\BoxType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BoxTypeController extends Controller
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
        $objects = BoxType::orderBy('name')->paginate(20);
        return view('box_types.index',compact('objects'));
    }


    public function create()
    {
        return view('box_types.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = new BoxType();
        $object->name = $request->name;
        $object->save();

        return redirect('box_types')->with('success','Creado correctamente.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $object = BoxType::findOrFail($id);
        return view('box_types.edit',compact('object'));
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = BoxType::findOrFail($id);
        $object->name = $request->name;
        $object->save();

        return redirect('box_types')->with('success','Editado correctamente.');
    }

   
    public function destroy($id)
    {
        BoxType::destroy($id);
        return redirect('box_types')->with('success','Eliminado correctamente.');
    }

   
}
