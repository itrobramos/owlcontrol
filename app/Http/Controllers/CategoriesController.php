<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoriesController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('brandId','desc')->orderBy('name','asc')->paginate(20);
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::orderBy('name','asc')->paginate(20);
        $data['brands'] = $brands;
        return view('categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'brand' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->brandId = $request->brand;

        if(isset($request->parentCategory)){
            $category->parentCategoryId = $request->parentCategory;
        }
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('categoriesUploads/images/', $filename);
            $category->imageUrl = 'categoriesUploads/images/'.$filename;
        }

        $category->save();

        return redirect('categories')->with('success','Categoría creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::orderBy('name','asc')->paginate(20);
        $category = Category::findOrFail($id);

        $data['brands'] = $brands;
        $data['category'] = $category;

        return view('categories.edit',$data);
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
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->brandId = $request->brand;

        if(isset($request->parentCategory)){
            $category->parentCategoryId = $request->parentCategory;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move('categoriesUploads/images/', $filename);
            $category->imageUrl = 'categoriesUploads/images/'.$filename;
        }
        $category->save();
        return redirect('categories')->with('success','Categoría editada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('categories')->with('success','Categoría eliminada correctamente.');
    }

    public function getCategoriesByBrand($id){
        $categories = Category::where('brandId',$id)->get();

        $categoriesResponse = [];
        foreach ($categories as $category) {
            $categoriesResponse[] = ["id" => $category->id, "name" => $category->name];
        }

        return [
            'statusCode' => 100,
            'data' => $categoriesResponse
        ];
    }
}
