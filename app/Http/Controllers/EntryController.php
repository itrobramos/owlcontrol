<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Entry;
use App\Models\EntryDetail;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Commands\Show;

class EntryController extends Controller
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
        $objects = Entry::orderBy('date')->paginate(20);
        return view('entries.index',compact('objects'));
    }


    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();    
        $currencies = Currency::orderBy('name')->get();    
        $products = Product::orderBy('name')->get();    
        return view('entries.create', compact('suppliers', 'currencies', 'products'));
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required',
        // ]);

        \DB::beginTransaction();
        try {

            $object = new Entry();
            $object->supplierId = $request->supplierId;
            $object->date = $request->date;
            $object->currencyId = $request->currencyId;

            $object->totalCost = 0;
            $object->shipCost = 0;
            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =time().'.'.$extension;
                $file->move('Uploads/images/', $filename);
                $object->imageUrl = 'Uploads/images/'.$filename;
               
            }

            $object->save();

            $Total = 0;
            $ShipTotal = 0;


            if(isset($request->product)){
                foreach($request->product as $product){

                    $EntryDetail = new EntryDetail();
                    $EntryDetail->entryId = $object->id;
                    $EntryDetail->productId = $product['productId'];
                    $EntryDetail->quantity = $product['quantity'];
                    $EntryDetail->unitPrice = $product['unitPrice'];
                    $EntryDetail->shipCost = $product['shipCost'];
                    
                    $EntryDetail->save();

                    $Total = $Total +  ($EntryDetail->unitPrice * $EntryDetail->quantity);
                    $ShipTotal = $ShipTotal + $EntryDetail->shipCost;
                    

                    //Actualizamos existencias del producto

                    $Producto = Product::find($EntryDetail->productId);
                    $Producto->stock = $Producto->stock + $EntryDetail->quantity;
                    $Producto->save();

                }

                $object->totalCost = $Total;
                $object->shipCost = $ShipTotal;
                $object->save();
            }



            \DB::commit();
            return redirect('entries')->with('success','Creada correctamente.');
        } catch (\Throwable $th) {
            dd($th);
            \DB::rollback();
            return redirect('entries')->with('warning', 'Error al crear la entrada.');
        }



    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $object = Entry::findOrFail($id);
        return view('entries.edit',compact('object'));
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = Entry::findOrFail($id);
        $object->name = $request->name;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/'.$filename;
        }
        $object->save();

        return redirect('entries')->with('success','Editado correctamente.');
    }

   
    public function destroy($id)
    {
        Entry::destroy($id);
        return redirect('entries')->with('success','Eliminado correctamente.');
    }

   
}
