<?php

namespace App\Http\Controllers;

use App\Models\Thematic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ThematicController extends Controller
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
        $objects = Thematic::orderBy('name')->paginate(20);
        return view('thematics.index',compact('objects'));
    }


    public function create()
    {
        return view('thematics.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = new Thematic();
        $object->name = $request->name;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/'.$filename;
        }

        $object->save();




        return redirect('thematics')->with('success','Creado correctamente.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $object = Thematic::findOrFail($id);
        return view('thematics.edit',compact('object'));
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = Thematic::findOrFail($id);
        $object->name = $request->name;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/'.$filename;
        }
        $object->save();

        return redirect('thematics')->with('success','Editado correctamente.');
    }

   
    public function destroy($id)
    {
        Thematic::destroy($id);
        return redirect('thematics')->with('success','Eliminado correctamente.');
    }

   
}
