<?php

namespace App\Http\Controllers;

// use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $userSession = Auth::user();
            if(!$this->checkRoleRoutePermission($userSession)){
                return response()->view('errors.error');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::where('clientId',Auth::user()->clientId)->paginate(20);
        return view('users.index',compact('users'));
    }


    public function create()
    {
        $userSession = Auth::user();
        $roles = Role::where('id','!=','1')->pluck('name','id');
        $filials = Filial::where('clientId',$userSession->clientId)->pluck('name','id');
        return view('users.create',compact('roles','filials'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:users,email|email',
            'roleId' => 'required',
            'Filials' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        // dd($request->all());
        
        $userSession = Auth::user();
        $user = new User();
        $user->name = $request->name;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->roleId = $request->roleId;
        $user->clientId = $userSession->clientId;
        $user->password = Hash::make( $request->password);
        $user->save();

        //Asignamos sucursales del request
        $filials = [];
        foreach ($request->Filials as $key => $id) {
            $filials[] = $id;
        }
      
        //Asignamos sucursales al usuario
        $user->filials()->sync($filials);

        //Todo: asignar rol al usuario
        $user->assignRole($request->roleId);

        return redirect('users')->with('success','Usuario creado correctamente.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $userSession = Auth::user();
        $this->checkRoleRoutePermission($userSession);

        // dd(\Route::currentRouteName());
        
        $user = User::findOrFail($id);
        
        $roles = Role::where('id','!=','1')->pluck('name','id');
        $filials = Filial::where('clientId',$userSession->clientId)->pluck('name','id');

        // dd($userSession);
        $userFilials = [];
        foreach ($user->filials as $key => $f) {
            $userFilials[] = $f->id;
        }
        // dd($userFilials);
       

        return view('users.edit',compact('user','roles','filials','userFilials'));
    }

    
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'roleId' => 'required',
            'Filials' => 'required'
        ]);

        // dd($request->all());

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->lastName = $request->lastName;
        $user->roleId = $request->roleId;
        $user->save();

        //buscamos rol para asignarlo
        $rol = Role::find($request->roleId);
        $user->syncRoles([ $rol->name ]);



         //Asignamos sucursales del request
         $filials = [];
         foreach ($request->Filials as $key => $id) {
             $filials[] = $id;
         }
       
         //Asignamos sucursales al usuario
         $user->filials()->sync($filials);
        return redirect('users')->with('success','Usuario editado correctamente.');
    }

   
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('users')->with('success','Usuario eliminado correctamente.');
    }

    public function x(){
        
        $role = Role::find(2);
        
        // $permission = Permission::create(['name' => 'users.index']);
        // $permissions = Permission::all();
        // dd($permissions);
        // $role->syncPermissions($permissions);
        // $user = User::find(auth()->user()->id);
        // // dd($user);

        // // $user->assignRole('admin');


        // $permission = Permission::create(['name' => 'users.index']);
        // $role->syncPermissions($permission);

        // dd($user->roles);

    }
}
