<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\BoxConfiguration;
use App\Models\ProductType;
use App\Models\Thematic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BoxController extends Controller
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
        $objects = Box::orderBy('name')->paginate(20);

        return view('boxes.index',compact('objects'));
    }


    public function create()
    {
        $thematics = Thematic::orderBy('name')->get();
        return view('boxes.create',compact('thematics'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $object = new Box();
        $object->name = $request->name;
        $object->price = $request->price;
        $object->thematicId = $request->thematicId;


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/'.$filename;
        }

        $object->save();

        return redirect('boxes')->with('success','Creado correctamente.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $object = Box::findOrFail($id);
        $thematics = Thematic::orderBy('name')->get();
        
        return view('boxes.edit',compact('object', 'thematics'));
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = Box::findOrFail($id);
        $object->name = $request->name;
        $object->price = $request->price;
        $object->thematicId = $request->thematicId;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/'.$filename;
        }
        $object->save();

        return redirect('boxes')->with('success','Editado correctamente.');
    }

   
    public function destroy($id)
    {
        Box::destroy($id);
        return redirect('boxes')->with('success','Eliminado correctamente.');
    }

    public function configure($id)
    {
        $object = Box::findOrFail($id);
        $thematics = Thematic::orderBy('name')->get();    
        $types = ProductType::orderBy('name')->get();  
        $contains = BoxConfiguration::where('boxId', $id)->get();

        return view('boxes.configure',compact('object', 'thematics', 'types', 'contains'));
    }

    public function configurePost(Request $request, $id)
    {

        $object = new BoxConfiguration();
        $object->boxId = $id;

        $object->productTypeId = $request->productTypeId;
        $object->quantity = $request->quantity;
        $object->value = $request->value;
        
        if(isset($request->thematicId))
            $object->thematicId = $request->thematicId;

        $object->save();

        return redirect()->back()->with('success','Agregado correctamente.');
    }

    public function configureDestroy($id){
        BoxConfiguration::destroy($id);
        return redirect()->back()->with('success','Eliminado correctamente.');
    }

   
}
