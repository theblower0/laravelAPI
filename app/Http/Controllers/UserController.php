<?php
 namespace App\Http\Controllers;

 use App\Models\User;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Str;

 class UserController extends Controller{
     function addUser(Request $request){
         $input = $request->all();
         $input['password'] = Hash::make($request->password);

         User::create($input);

         return response()->json([
             'res' => true,
             'message' => 'Registro insertado correctamente'
         ]);
     }

     function login(Request $request){
         $user = User::whereName($request->name)->first();
         if(!is_null($user) && Hash::check($request->password, $user->password)){
            
            $user->api_token = Str::random(32);
            $user->save();

            return response()->json([
                'res' => true,
                'token' => $user->api_token,
                'message' => 'Dentro del sistema',
                'name' => $user->name

                ]);
         }else{
             return response()->json([
                 'res' =>false,
                 'message' => 'Cuenta o password incorrecto'
             ]);
         }
     }

     function logout(){
         $user = auth()->user();
         $user->api_token = null;
         $user->save();

         return response()->json([
             'res' => true,
             'message' => 'Saliste de la sesión'
         ]);
     }

     function view(){
        $user = User::all();
        return response()->json(['message' => 'Mostrando los usuarios',$user]);
     }

 }