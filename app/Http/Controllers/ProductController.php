<?php

namespace App\Http\Controllers;

use App\Models\ExpiryControl;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Thematic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function __construct()
    {
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
        $objects = Product::orderBy('name')->paginate(20);
        return view('products.index', compact('objects'));
    }


    public function create()
    {
        $thematics = Thematic::orderBy('name')->get();
        $types = ProductType::orderBy('name')->get();
        $SKU = Product::max('sku') + 1;
        return view('products.create', compact('thematics', 'types', 'SKU'));;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $LastSKU = Product::max('SKU');

        $object = new Product();
        $object->name = $request->name;
        $object->internal_name = $request->internal_name;
        $object->description = $request->description;
        $object->stock = 0;
        $object->value = $request->value;

        if ($LastSKU == null)
            $object->SKU = 1;
        else
            $object->SKU = $LastSKU + 1;


        if (isset($request->expiryDate))
            $object->expiryDate = true;
        else
            $object->expiryDate = false;


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/' . $filename;
        }

        $object->productTypeId = $request->productTypeId;

        if (isset($request->thematicId))
            $object->thematicId = $request->thematicId;

        $object->save();

        return redirect('products')->with('success', 'Creado correctamente.');
    }


    public function show($id)
    {
    }

    public function edit($id)
    {
        $object = Product::findOrFail($id);
        $thematics = Thematic::orderBy('name')->get();
        $types = ProductType::orderBy('name')->get();
        return view('products.edit', compact('object', 'thematics', 'types'));;
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $object = Product::findOrFail($id);
        $object->name = $request->name;
        $object->internal_name = $request->internal_name;
        $object->description = $request->description;
        $object->stock = $request->stock;
        $object->value = $request->value;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/' . $filename;
        }

        $object->productTypeId = $request->productTypeId;

        if (isset($request->thematicId))
            $object->thematicId = $request->thematicId;

        if (isset($request->expiryDate))
            $object->expiryDate = true;
        else
            $object->expiryDate = false;


        $object->save();
        return redirect('products')->with('success', 'Editado correctamente.');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('products')->with('success', 'Eliminado correctamente.');
    }

    public function merma($id)
    {
        $Expiry = ExpiryControl::find($id);
        $Expiry->available = false;
        $Expiry->merma = true;
        $Expiry->save();
        return redirect()->back()->with('success','Merma guardada correctamente.');
    }

    public function fifo($id){
        $object = Product::find($id);
        $controlExpiration = ExpiryControl::where('productId', $id)->where('available', 1)->paginate(20);

        return view('products.fifo', compact('object', 'controlExpiration'));
    }

    public function sold($id){
        $Expiry = ExpiryControl::find($id);
        $Expiry->available = false;
        $Expiry->save();
        return redirect()->back()->with('success','Venta guardada correctamente.');
        
    }
}
