<?php
 namespace App\Http\Controllers;

 use App\Models\Orders;
 use App\Models\DetailOrder;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Str;
 use App\Http\Controllers\Controller;

 class OrdersController extends Controller{
    
    function addOrder(Request $request){
        $input = $request->all();
            Orders::create($input);

            return response()->json([
                'res' => true,
                'message' => 'Se ha agregado un pedido',
                ]);
    }

    function viewOrdersWithDetail(){
        $order = Orders::with('detail')->get();
        return response()->json([
            'message' => 'Mostrando las ordenes con detalles',
            $order]);
     }

     function viewOrders(){
        $order = Orders::all();
        return response()->json([
            'message' => 'Mostrando las ordenes',
            $order]);
     }

     function deleteOrder(Request $request){
        $erase = Orders::whereId($request->id_orden)->first();
        $detail = DetailOrder::where('orders_id',$request->id_orden)->get();
        
        $erase->delete();
        $detail->each->delete();

        return response()->json(['message' => 'Orden eliminada']);
     }


 }