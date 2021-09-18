<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\BoxConfiguration;
use App\Models\Client;
use App\Models\EntryDetail;
use App\Models\ExpiryControl;
use App\Models\FilledBox;
use App\Models\FilledBoxDetail;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Thematic;
use App\Models\Sale;
use App\Models\SaleExpenseType;
use App\Models\SaleOrigin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BoxController extends Controller
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
        $objects = Box::orderBy('name')->paginate(20);

        return view('boxes.index', compact('objects'));
    }


    public function create()
    {
        $thematics = Thematic::orderBy('name')->get();
        return view('boxes.create', compact('thematics'));
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

        if (isset($request->thematicId)) {
            $object->thematicId = $request->thematicId;
        }


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/' . $filename;
        }

        $object->save();

        return redirect('boxes')->with('success', 'Creado correctamente.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $object = Box::findOrFail($id);
        $thematics = Thematic::orderBy('name')->get();

        return view('boxes.edit', compact('object', 'thematics'));
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
            $filename = time() . '.' . $extension;
            $file->move('Uploads/images/', $filename);
            $object->imageUrl = 'Uploads/images/' . $filename;
        }
        $object->save();

        return redirect('boxes')->with('success', 'Editado correctamente.');
    }


    public function destroy($id)
    {
        Box::destroy($id);
        return redirect('boxes')->with('success', 'Eliminado correctamente.');
    }

    public function configure($id)
    {
        $object = Box::findOrFail($id);
        $thematics = Thematic::orderBy('name')->get();
        $types = ProductType::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        $contains = BoxConfiguration::where('boxId', $id)->orderByDesc('productId')->get();

        return view('boxes.configure', compact('object', 'thematics', 'types', 'contains', 'products'));
    }

    public function configurePost(Request $request, $id)
    {
        $object = new BoxConfiguration();
        $object->boxId = $id;

        if ($request->configurationType == "variante") {
            $object->productTypeId = $request->productTypeId;
            $object->quantity = $request->quantity;
            $object->value = $request->value;

            if (isset($request->thematicId))
                $object->thematicId = $request->thematicId;
        } else {
            $Product = Product::find($request->productId);
            $object->productTypeId = $Product->productTypeId;
            $object->quantity = 1;
            $object->value = $Product->value;
            $object->productId = $request->productId;
        }

        $object->save();

        return redirect()->back()->with('success', 'Agregado correctamente.');
    }

    public function configureDestroy($id)
    {
        BoxConfiguration::destroy($id);
        return redirect()->back()->with('success', 'Eliminado correctamente.');
    }

    public function building()
    {
        $objects = Box::orderBy('name')->paginate(20);
        return view('boxes.building', compact('objects'));
    }

    public function boxbuildingstep2($id)
    {
        $box = Box::find($id);
        $variablecontains = BoxConfiguration::where('boxId', $id)->whereNull('productId')->orderBy('productTypeId')->with('product', 'entriesDetails')->get();
        $fixedcontainsarray = BoxConfiguration::where('boxId', $id)->whereNotNull('productId')->orderBy('productTypeId')->with('product')->get();

        $fixedcontains = [];

        // dd($fixedcontainsarray[0]->product->entriesDetails);

        foreach ($fixedcontainsarray as $fixed) {
            $fixedcontains[$fixed->id] = [
                "name" => $fixed->product->name,
                "id" => $fixed->product->id,
                "imageUrl" => $fixed->product->imageUrl,
                "price" => $fixed->product->entriesDetails->last()->unitPrice + ($fixed->product->entriesDetails->last()->shipCost / $fixed->product->entriesDetails->last()->quantity)
            ];
        }


        $data = [];
        $previousTypeId = 0;

        foreach ($variablecontains as $variable) {

            $products = null;

            $products = Product::where('stock', '>', 0)
                ->where('value', '>=', $variable->value)
                ->where('productTypeId', $variable->productTypeId)
                ->with('entriesDetails', 'expiryControl');


            if (isset($variable->thematic))
                $products->where('thematicId', $variable->thematicId);

            $products = $products->get();


            if ($products->count() > 0) {

                foreach ($products as $product) {
                    if ($product->expiryDate == 1) {
                        $expiryDate = $product->expiryControl->where('date', $product->expiryControl->min('date'))->first();

                        if ($expiryDate != null) {
                            $product->expiryDate = $expiryDate->date;
                            $product->price = $expiryDate->price;
                        } else {
                            $product->price = $product->entriesDetails[0]->max('unitPrice');
                        }
                    } else {

                        $product->price = $product->entriesDetails[0]->max('unitPrice');
                    }
                }
            }

            // dd($products[0]->entriesDetails);


            if ($variable->productTypeId != $previousTypeId) {
                $data[$variable->productTypeId]['type'][] = [
                    "name" => $variable->type->name,
                    "id" => $variable->id
                ];

                $data[$variable->productTypeId]['contains'][] = [
                    'type'     => $variable->type->name,
                    'quantity' => $variable->quantity,
                    'value' => $variable->value,
                    'thematic' => $variable->thematic ? $variable->thematic->name : null,
                    'products' => json_decode($products),
                    'productCount' => $products->sum('stock')
                ];
            } else {

                $data[$variable->productTypeId]['contains'][] = [
                    'type'     => $variable->type->name,
                    'quantity' => $variable->quantity,
                    'value' => $variable->value,
                    'thematic' => $variable->thematic ? $variable->thematic->name : null,
                    'products' => json_decode($products),
                    'productCount' => $products->sum('stock')
                ];
            }

            $previousTypeId = $variable->productTypeId;
        }

        // dd($data);
        return view('boxes.buildingstep2', compact('data', 'fixedcontains', 'box'));
    }

    public function saveBuild(Request $request)
    {

        $userSession = Auth::user();
        $total = 0;

        $FilledBox = new FilledBox();
        $FilledBox->userId = $userSession->id;
        $FilledBox->name = $request->name;
        $FilledBox->money = 0;
        $FilledBox->save();

        foreach ($request->item as $item) {
            $FilledBoxDetail = new FilledBoxDetail();
            $FilledBoxDetail->filledBoxId = $FilledBox->id;
            $FilledBoxDetail->productId = $item['id'];
            $FilledBoxDetail->price = $item['price'];
            $FilledBoxDetail->save();

            $total = $total + $FilledBoxDetail->price;
        }

        $FilledBox->money = $total;
        $FilledBox->save();

        return redirect('boxes')->with('success', 'Armada correctamente.');
    }

    public function builtboxes()
    {
        $objects = FilledBox::where('sold', false)->orderBy('created_at')->paginate(20);
        return view('boxes.builtboxesindex', compact('objects'));
    }

    public function sale($id)
    {
        $object = FilledBox::findOrFail($id);
        $expensesTypes = SaleExpenseType::orderBy('name')->get();
        $saleOrigins = SaleOrigin::orderBy('name')->get();

        return view('boxes.sale', compact('object', 'expensesTypes', 'saleOrigins'));
    }

    public function clientStore(Request $request, $id)
    {
        \DB::beginTransaction();
        try {
            //Guardado del cliente
            $userSession = Auth::user();
            $Client = new Client();
            $Client->name = $request->name;

            if (isset($request->lastName))
                $Client->lastName = $request->lastName;

            if (isset($request->fb))
                $Client->fb = $request->fb;

            if (isset($request->instagram))
                $Client->instagram = $request->instagram;

            if (isset($request->phone))
                $Client->phone = $request->phone;

            if (isset($request->email))
                $Client->email = $request->email;

            $Client->save();
            echo 'Cliente creado';

            //Guardado de la venta
            $Sale = new Sale();

            $Sale->date = $request->date;
            $Sale->price = $request->price;
            $Sale->saleOriginId = $request->origin;

            if (isset($request->comments))
                $Sale->comments = $request->comments;

            if (isset($request->delivery))
                $Sale->delivery = $request->delivery;

            $Sale->userId = $userSession->id;
            $Sale->filledBoxId = $id;
            $Sale->save();

            echo 'Venta creada';
            //Rebajo de inventario

            $contains = FilledBoxDetail::where('filledBoxId', $id)->get();

            foreach($contains as $contain){

                $Product = Product::find($contain->productId);
                $Product->stock = $Product->stock - 1;

                if($Product->expiryDate == 1){
                    $expiryDate = $Product->expiryControl->where('date', $Product->expiryControl->min('date'))->first();

                    if ($expiryDate != null) {
                        $minDate =  $Product->expiryControl->min('date');
                        $expiryControl = $Product->expiryControl->where('date', $minDate)->where('available', 1)->where('productId', $Product->id)->first();
                        $expiryControl->available = false;
                        $expiryControl->save();
                    }
                }
            }

            //Se marca como vendida la caja armada
            $FilledBox = FilledBox::find($id);
            $FilledBox->sold = true;
            $FilledBox->save();

            DB::commit();
            return redirect('builtboxes')->with('success','Venta registrada correctamente.');
        } 
        catch (\Throwable $th) 
        {
            dd($th);
            \DB::rollback();
            return redirect('builtboxes')->with('warning', 'Error al crear la venta.');

        }
    }
}
