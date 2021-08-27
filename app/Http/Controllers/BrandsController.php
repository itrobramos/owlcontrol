<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\PriceTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BrandsController extends Controller
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
        $brands = Brand::paginate(20);
        return view('brands.index',compact('brands'));
    }


    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('brandsUploads/images/', $filename);
            $brand->imageUrl = 'brandsUploads/images/'.$filename;
        }

        $brand->save();

        foreach ($request->pricetag as $key => $pricetag) {
            
            $PriceTag = new PriceTag();
            $PriceTag->brandId = $brand->id;
            $PriceTag->name = $pricetag;
            $PriceTag->save();

        }


        return redirect('brands')->with('success','Marca creada correctamente.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.edit',compact('brand'));
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('brandsUploads/images/', $filename);
            $brand->imageUrl = 'brandsUploads/images/'.$filename;
        }
        $brand->save();

        foreach ($request->pricetag as $key => $pricetag) {
            
            if($key == 0){
                $PriceTag = new PriceTag();
                $PriceTag->name = $pricetag;
                $PriceTag->brandId = $brand->id;
                $PriceTag->save();
            }
            else{
                $PriceTag = PriceTag::find($key);
                $PriceTag->name = $pricetag[0];
                $PriceTag->save();
    
            }
        }


        return redirect('brands')->with('success','Marca editada correctamente.');
    }

   
    public function destroy($id)
    {
        Brand::destroy($id);
        return redirect('brands')->with('success','Marca eliminada correctamente.');
    }

    public function getBrands(){
        $brands = Brand::get();

        $brandsResponse = [];
        foreach ($brands as $brand) {
            $brandsResponse[] = ["id" => $brand->id, "name" => $brand->name];
        }

        return [
            'statusCode' => 100,
            'data' => $brandsResponse
        ];
    }

    public function getPriceTags($id){
        $brand = Brand::find($id);

        $PriceTagsResponse = [];
        foreach ($brand->priceTags as $priceTag) {
            $PriceTagsResponse[] = ["id" => $priceTag->id, "name" => $priceTag->name];
        }

        return [
            'statusCode' => 100,
            'data' => $PriceTagsResponse
        ];
    }
}
