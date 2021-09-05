<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentMethodController extends Controller
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
        $objects = PaymentMethod::orderBy('name')->paginate(20);
        return view('paymentmethods.index',compact('objects'));
    }


    public function create()
    {
        return view('paymentmethods.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = new PaymentMethod();
        $object->name = $request->name;
        $object->property = $request->property;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/'.$filename;
        }

        $object->save();




        return redirect('paymentmethods')->with('success','Creado correctamente.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $object = PaymentMethod::findOrFail($id);
        return view('paymentmethods.edit',compact('object'));
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = PaymentMethod::findOrFail($id);
        $object->name = $request->name;
        $object->property = $request->property;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/'.$filename;
        }
        $object->save();

        return redirect('paymentmethods')->with('success','Editado correctamente.');
    }

   
    public function destroy($id)
    {
        PaymentMethod::destroy($id);
        return redirect('paymentmethods')->with('success','Eliminado correctamente.');
    }

   
}
