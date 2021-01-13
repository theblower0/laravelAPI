<?php
 namespace App\Http\Controllers;

 use App\Models\DetailOrder;
 use App\Models\Orders;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Str;

 class DetailOrderController extends Controller{
    
    function addDetailOrder(Request $request){
        $input = $request->all();
            DetailOrder::create($input);

            return response()->json([
                'res' => true,
                'message' => 'Se ha agregado los detalles de orden',
                ]);
    }

    

 }