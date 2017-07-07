<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrder;
use App\Product;
use App\Order;
use App\OrderItem;
use App\Category;
use App\User;
use App\Taxonomy;
use Cart;
use Auth;

class CartController extends Controller
{
    /**
    * Show a listing of product in cart
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        if(Cart::count() == 0){
            return redirect()->to('gio-hang-rong');
        }
        $taxonomies = Taxonomy::get();
        $categories = Category::get();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();
        foreach (Cart::content() as $key => $item) {
            Cart::setTax($key,0);
        }
    	return view('carts.index', ['categories' => $categories, 'bestSeller' => $bestSeller,'taxonomies' => $taxonomies]);
    }

    /**
    * Add product to cart
    *
    * @return none
    */
    public function create($id){
    	$product = Product::find($id);
    	$price   = $product->sale == 0?$product->price:$product->sale; 
    	Cart::add($id, $product->title, 1, $price, ['image' => $product->image]);

    	echo Cart::content()->count();
    }

    public function cartEmpty(){
        $categories = Category::get();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();
        $taxonomies = Taxonomy::get();
        return view('carts.cart-empty', ['categories' => $categories, 'bestSeller' => $bestSeller,'taxonomies' => $taxonomies]);
    }

    public function success(){
        $categories = Category::get();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();
        return view('carts.success', ['categories' => $categories, 'bestSeller' => $bestSeller]);
    }

    /**
    * Add product to cart
    *
    * @return \Illuminate\Http\Response
    */
    public function add(Request $request){
        $product = Product::find($request->product_id);
        $qty     = $request->qty;

        if($qty==0){
            return redirect()->back()->with('error','Vui lòng chọn số lượng');
        }

        $price   = $product->sale == 0?$product->price:$product->sale;  
        Cart::add($product->id, $product->title, $qty, $price, ['image' => $product->image]);

        return redirect()->to('gio-hang');
    }

    public function addSingleItem($id){
        $product = Product::find($id);
        $qty     = 1;

        $price   = $product->sale == 0?$product->price:$product->sale;  
        Cart::add($product->id, $product->title, $qty, $price, ['image' => $product->image]);

        return redirect()->to('gio-hang');
    }

    /**
    * Show pay form
    *
    * @return \Illuminate\Http\Response
    */
    public function pay(){
        if(Cart::content()->count() == 0)
            return redirect()->to('gio-hang-rong');
        $categories = Category::get();

        return view('carts.pay', ['categories' => $categories]);
    }

    /**
    * Update cart
    *
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request){
        $input = array_except($request->all(), array('_token'));
        foreach($input as $key => $value){
            Cart::update($key, $value);
        }

        return redirect()->to('/gio-hang')->with('success','Cập nhật thành công!');
    }

    /**
    * Handle pay request
    *
    * @return \Illuminate\Http\Response
    */
    public function store(StoreOrder $request){
        $order = new Order;
        $data = array(
            'name'  => $request->name,
            'email' => $request->email
        );

        $user = null;

        //Save user id, evaluate 0 if user not login
        if(Auth::check()){
            $order->user_id = Auth::user()->id;
        }else{
            $order->user_id = 0;
        }
        $order->customer_info = json_encode($data);
        $order->address       = $request->address;
        $order->note          = $request->note;
        $order->phone         = $request->phone;
        $order->subtotal      = Cart::subtotal(0,'','');
        $order->payment       = $request->_payment;

        //User use coupon
        if($request->_coupon == 1){
            $order->subtotal = $order->subtotal - ($order->subtotal * 0.1);
        }

        if(Auth::check()){
            $user = User::find(Auth::user()->id);
            $user->coupon = $user->coupon + Cart::count() * 50;
            $user->save();
        }

        if($request->_payment == 'viliti'){
            $user = User::find(Auth::user()->id);
            $user->balance = $user->balance - $order->subtotal;
            $order->payment_status = 1;
            $user->save();
        }

        $order->save();

        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem;
            $orderItem->order_id   = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->qty        = $item->qty;
            $orderItem->total      = $item->total;
            $product               = Product::find($item->id);
            $product->buy          = $product->buy + $item->qty; 
            $product->save();

            $orderItem->save();
        }

        Cart::destroy();

        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();

        if($request->_payment == 'paypal'){
            return view('pages.paypal', compact('categories', 'bestSeller', 'taxonomies', 'order'));
        }

        return view('carts.success',['categories' => $categories, 'bestSeller' => $bestSeller, 'taxonomies' => $taxonomies]);
    }

    public function destroy(){
        Cart::destroy();
        return redirect()->to('/gio-hang')->with('sucess','Bạn đã hủy giỏ hàng!');
    }
}
