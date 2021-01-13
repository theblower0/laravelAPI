<?php
 namespace App\Http\Controllers;

 use App\Models\Menu;
 use League\Flysystem\Filesystem;
 use League\Flysystem\Adapter\Local;
 use Illuminate\Support\Facades\Storage;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Str;

 class MenuController extends Controller{

    function addProduct(Request $request){
        $input = $request->all();
        $data = Menu::where('id_producto',$request->id_producto)->first();

        // $data->image = $input['image'];
        // $data->name_image = $input['name_image'];
        // $data->save();
        // $adapter = new Local(__DIR__.'app/public');
        // $filesystem = new Filesystem($adapter);

        if($data==null){

            // $name = $input['name_image'];
            // $image = $input['image'];
            //$realImage = base64_encode($input['image']);
            // file_put_contents($name,$realImage);

        // //  //   file_put_contents($name,$realImage);
        //    $filePath = 'C:/laragon/www/tacos-app/public/';
        //     //Storage::disk('local')->putFileAs('images', $image, $name);
        //     $filesystem->write($filePath, $image, 'public');


            Menu::create([
                'id_producto' => $input['id_producto'],
                'nombre_producto'=> $input['nombre_producto'],
                'precio' => $input['precio'],
                'name_image'=> $input['name_image'],
                'image'=> $input['image'],
            ]);

            return response()->json([
                'res' => true,
                'message' => 'Registro de producto exitoso']);
        }else{
            return response()->json([
                
                'res' => false,
                'message' => 'ID de producto ya se encuentra registrada',
                
                ]);
        }
        
        
    }



    function addImageProducts(Request $request){
        $input = Menu::where('id_producto',$request->id_producto)->first();
     }
     
    function viewProducts(){
        $menu = Menu::all();
        return response()->json($menu);
     }

     function deleteProduct(Request $request){
        $menu = Menu::where('id_producto',$request->id_producto)->first();
        $menu->delete();

        return response()->json(['message' => 'Producto eliminado']);
     }

     function updateProduct(Request $request){
         
         
         $menu = Menu::where('id_producto',$request->id_producto)->first();
         //$filePath = 'C:/laragon/www/tacos-app/public/';

         if($menu['id_producto'] == $request['id_producto']){

            // $deleteImage = $menu['name_image'];
          
            // $name = $request['name_image'];
            // $image = $request['image'];
            // $realImage = base64_decode($image);
            // file_put_contents($name,$realImage);

            $menu['id_producto'] = $request['id_producto'];
            $menu['nombre_producto'] = $request['nombre_producto'];
            $menu['precio']= $request['precio'];
            $menu['image'] = $request['image'];
            $menu['name_image']= $request['name_image'];
            $menu->save();
   
            return response()->json([
                'res' => true,
                'message' => 'Producto actualizado']);
         }else{
            return response()->json([
                'res' => false,
                'message' => 'No se pudo actualizar']);
         }
         
     }

     


 }