<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTagPrice;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $userSession = Auth::user();
        //     if (!$this->checkRoleRoutePermission($userSession)) {
        //         return response()->view('errors.error');
        //     }
        //     return $next($request);
        // });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('name', 'Asc')->paginate(20);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'Asc')->pluck('name', 'id');
        $brands = Brand::orderBy('name','asc')->paginate(20);
        $data['brands'] = $brands;
        $data['categories'] = $categories;
        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        //     'ingredient' => 'required',
        //     'ingredient.*.ingredientId' => 'required',
        //     'ingredient.*.quantity' => 'required',
        //     'ingredient.*.measurementUnitId' => 'required',
        //     'ingredient.*.measurementUnitId' => 'required',
        //     'prices.*' => 'required',
        //     'option.*.optionId' => 'required',
        //     'option.*.extraCost' => 'required',
        // ]);


        \DB::beginTransaction();
        try {

            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->categoryId = $request->categoryId;
            $product->code = $request->code;
            $product->save();


            //Guardado de Producto_Plataforma
            foreach ($request->prices as $key => $price) {


                if($price == null)
                    $price = 0;
                    
                $ProductTagPrice = new ProductTagPrice();

                $ProductTagPrice->productId = $product->id;
                $ProductTagPrice->price = $price;
                $ProductTagPrice->priceTagId = $key;
                $ProductTagPrice->save();


            }

            $cont = 0;
            //Guardado de imagenes
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $cont++;
                    $file = $image;
                    $extension = $file->getClientOriginalExtension(); // getting image extension
                    $filename = time() . $cont . '.' . $extension;
                    $file->move('productsUploads/images/', $filename);

                    $data[] =
                        ['productId' => $product->id, 'imageUrl' => "productsUploads/images/" . $filename];
                }

                ProductImage::insert($data);
            }

            \DB::commit();
            return redirect('products')->with('success', 'Producto creado correctamente.');
        } catch (\Throwable $th) {
            dd($th);
            \DB::rollback();
            return redirect('products')->with('warning', 'Error al crear el producto.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->with('platforms', 'ingredients', 'options', 'options.variant', 'images', 'category')->first();
        // dd($product);
        $measurementUnits = MeasurementUnit::orderBy('shortName', 'Asc')->pluck('shortName', 'id');
        return view('products.show', compact('product', 'measurementUnits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userSession = Auth::user();
        // dd($id);
        $product = Product::where('id', $id)->with('platforms', 'ingredients', 'options', 'options.variant', 'images')->first();
        $client = Client::findOrFail($userSession->clientId);
        // dd($product);
        $platformsClient = $client->platforms->pluck('name', 'id');
        // dd($platforms);

        $prices = [];
        foreach ($product->platforms as $k => $v) {
            $prices[$v->id] = $v->pivot->price;
        }

        // dd($product->images);



        $categories = Category::where('clientId', $userSession->clientId)->orderBy('name', 'Asc')->pluck('name', 'id');
        $ingredients = Ingredient::where('clientId', $userSession->clientId)->orderBy('name', 'Asc')->pluck('name', 'id');
        $variants = Variant::where('clientId', $userSession->clientId)->orderBy('name', 'Asc')->get();
        $measurementUnits = MeasurementUnit::orderBy('shortName', 'Asc')->pluck('shortName', 'id');


        return view('products.edit', compact('product', 'categories', 'ingredients', 'variants', 'client', 'measurementUnits', 'platformsClient', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'ingredient' => 'required',
            'ingredient.*.ingredientId' => 'required',
            'ingredient.*.quantity' => 'required',
            'ingredient.*.measurementUnitId' => 'required',
            'ingredient.*.measurementUnitId' => 'required',
            'prices.*' => 'required',
            'option.*.optionId' => 'required',
            'option.*.extraCost' => 'required',
        ]);
        // dd($request->all());

        \DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->categoryId = $request->categoryId;
            $product->save();

            $ingredients = [];
            if (isset($request->ingredient)) {
                foreach ($request->ingredient as $k => $ingredient) {
                    // Este indice en el array tiene que hacer referencia
                    //al id del Ingrediente,porque los valores del array son los valores que va a tomar ese ingrediente
                    $ingredients[$ingredient['ingredientId']] = ['quantity' => $ingredient['quantity'], 'measurementUnitId' => $ingredient['measurementUnitId'], 'notes' => $ingredient['notes']];
                }
                //update de todos los ingredientes
                $product->ingredients()->sync($ingredients);
            }

            if (isset($request->prices)) {
                $prices = [];
                foreach ($request->prices as $k => $price) {
                    $prices[$k] = ['price' => $price];
                }
                $product->platforms()->sync($prices);
            }

            if (isset($request->option)) {
                $options = [];
                foreach ($request->option as $k => $option) {
                    $options[$option['optionId']] = ['extraCost' => $option['extraCost']];
                }
                $product->options()->sync($options);
            }

            $cont = 0;
            //Guardado de imagenes
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $cont++;
                    $file = $image;
                    $extension = $file->getClientOriginalExtension(); // getting image extension
                    $filename = time() . $cont . '.' . $extension;
                    $file->move('productsUploads/images/', $filename);

                    $data[] =
                        ['productId' => $product->id, 'imageUrl' => "productsUploads/images/" . $filename];
                }

                ProductImage::insert($data);
            }

            \DB::commit();
            return redirect('products')->with('success', 'Producto editado correctamente.');
        } catch (\Throwable $th) {
            \DB::rollback();
            return redirect('products')->with('warning', 'Error al editar el producto.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('products')->with('success', 'Producto eliminado correctamente.');
    }

    public function deleteImageProduct(Request $request)
    {
        // dd($request->all());
        ProductImage::destroy($request->id);

        return [
            'statusCode' => 100
        ];
    }
}
