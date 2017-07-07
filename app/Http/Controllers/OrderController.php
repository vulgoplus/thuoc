<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;

class OrderController extends Controller
{
    public function index(){
    	$breadcrumps = array(
    	    0 => [ 'name' => 'Đơn hàng' ],
    	);

    	$orders = App\Order::orderBy('id','DESC')->paginate(15);

    	return view('admin.orders.index',compact('orders','breadcrumps'));
    }

    public function changePaymentStatus(Request $request){
    	$order = App\Order::find($request->order_id);
    	$order->payment_status = $request->status;

    	$order->save();
    }

    public function changeStatus(Request $request){
        $order = App\Order::find($request->order_id);

        $order->status = $request->status;
        if($order->payment == 'cash'){
            $order->payment_status = 1;
        }

        $order->save();
    }

    public function show($id){
        $order = App\Order::find($id);

        $breadcrumps = array(
            0 => [ 'name' => 'Đơn hàng', 'href' => url('admin/orders') ],
            1 => [ 'name' => 'Đơn hàng #'.$order->id]
        );

        return view('admin.orders.show',compact('order', 'breadcrumps'));
    }

    public function delete(Request $request){
        $id = $request->id;

        App\Order::destroy($id);
        echo "Deleted!";
    }

    public function destroy($id){
        $order = App\Order::find($id);

        $order->delete();
    }

    public function filter(Request $request){
        if($request->from == '' && $request->to == ''){
            return redirect()->to('admin/orders');
        }
        $a = $request->from;
        $b = $request->to;

        $from = date("Y-m-d H:i:s", strtotime($a));
        $to   = date("Y-m-d H:i:s", strtotime($b));

        $breadcrumps = array(
            0 => [ 'name' => 'Đơn hàng' ],
        );
        $orders = null;
        
        if($request->to == ''){
             $orders = DB::select(DB::raw('select * from `orders` where created_at > \''.$from.'\''));
        }elseif($request->from == ''){
            $orders = DB::select(DB::raw('select * from `orders` where created_at < \''.$to.'\''));
        }else{
            $orders = DB::select(DB::raw('select * from `orders` where created_at BETWEEN \''.$from.'\' AND \''.$to.'\''));
        }


        return view('admin.orders.index',compact('orders','breadcrumps', 'a', 'b'));
    }
}