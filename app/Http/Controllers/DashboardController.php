<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Date;
use App\Comment;
use App\User;
use App\Product;

class DashboardController extends Controller
{
	public function index(){
		$previous = $this->previousVenue();
		$current  = $this->currentVenue();
		$comments = Comment::count();
		$orders   = Order::count();
		$users    = User::count();
		$products = Product::count();

        $newOrder = Order::where('status',0)->count();
        session(['newOrder' => $newOrder]);

		$venue    = Order::select(DB::raw('IFNULL(SUM(subtotal),0) AS venue'))->where('payment_status', 1)->whereRaw('YEAR(created_at) = '.date('Y'))->first()->venue;
		$fVenue   = Order::select(DB::raw('IFNULL(SUM(subtotal),0) AS venue'))->where('payment_status', 1)->whereRaw('YEAR(created_at) = '.(date('Y') - 1))->first()->venue;

		return view('admin.home',compact('previous','current','comments','orders','users','products','venue','fVenue'));
	}


	public function currentVenue(){
		$currentVenue  = Date::select('dates.id',DB::raw('IFNULL(SUM(subtotal), 0) as venue'))
    		->where(DB::raw('YEAR(`orders`.`created_at`)'), '=', date('Y'))
            ->where('payment_status', 1)
    		->leftJoin('orders', DB::raw('MONTH(`created_at`)'), '=', 'dates.id')
    		->groupBy('dates.id')
    		->orderBy('dates.id')
    		->get();
    	$x = array();
    	for ($i = 1; $i <= 12; $i++) {
    		if($currentVenue->contains($i)){
    			$x[] = $currentVenue->find($i)->venue/1000;
    		}else{
    			$x[] = 0;
    		}
    	}

    	return $x;
	}
    public function previousVenue(){
    	$previousVenue = Date::select('dates.id',DB::raw('IFNULL(SUM(subtotal), 0) as venue'))
    		->where(DB::raw('YEAR(`orders`.`created_at`)'), '=', date('Y') - 1)
            ->where('payment_status', 1)
    		->leftJoin('orders', DB::raw('MONTH(`created_at`)'), '=', 'dates.id')
    		->groupBy('dates.id')
    		->orderBy('dates.id')
    		->get();
    	
    	$y = array();
    	for ($i = 1; $i <= 12; $i++) {
    		if($previousVenue->contains($i)){
    			$y[] = $previousVenue->find($i)->venue/1000;
    		}else{
    			$y[] = 0;
    		}
    	}

    	return $y;
    }
}
