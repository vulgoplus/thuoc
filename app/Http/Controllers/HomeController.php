<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\WishList;
use Auth;
use App\Post;
use App\Taxonomy;
use App;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $featured   = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'id')
            ->inRandomOrder()->limit(10)->where('featured',1)->get();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();
        $randoms    = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->inRandomOrder()->limit(3)->get();
        $males      = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->where('categories.parent',1)->get();
        $females    = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->where('categories.parent',2)->get();
        $acsrs      = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->where('categories.parent',3)->get();

        $wishs = array();
        if(Auth::check()){
            $temp = WishList::where('user_id',Auth::user()->id)->get();
            foreach($temp as $val){
                $wishs[] = $val->product_id;
            }
        }
        return view('home',[ 
            'categories' => $categories,
            'featured'   => $featured,
            'males'      => $males, 
            'females'    => $females, 
            'acsrs'      => $acsrs, 
            'randoms'    => $randoms,
            'bestSeller' => $bestSeller,
            'wishs'      => $wishs,
            'taxonomies' => $taxonomies
        ]);
    }

    /**
    * Show user profiles
    *
    * @return \Illuminate\Http\Response
    */
    public function showProfile(){
        if(!Auth::check()){
            echo '<h1>Bạn chưa đăng nhập!</h1>';
            return;
        }
        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();

        $orders     = App\Order::where('user_id',Auth::user()->id)->get();

        return view('pages.user-info',compact('categories','taxonomies','bestSeller','orders'));
    }

    /**
    * Show hint for search form
    *
    * @param \Illuminate\Http\Request $request
    * @return Json
    */
    public function autoComplete(Request $request){
        $key = $request->q;
        $products = Product::select('title as value','title as label','id')->where('title','like','%'.$key.'%')->get();
        return $products->toJson();
    }

    /**
    * Show listing of product with search key
    *
    * @param \Illuminate\Http\Request
    * @return \Illuminate\Http\Response
    */
    public function search(Request $request){
        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();
        $wishs = array();
        if(Auth::check()){
            $temp = WishList::where('user_id',Auth::user()->id)->get();
            foreach($temp as $val){
                $wishs[] = $val->product_id;
            }
        }
        $keyword  = $request->s;
        $products = Product::select('title','image','price','sale','slug')->where('title','like','%'.$keyword.'%')->get();

        return view('pages.search',compact('categories','taxonomies','bestSeller','products','keyword','wishs'));
    }

    /**
    * Show single products
    *
    * @param string $slug
    * @return \Illuminate\Http\Response 
    */
    public function showProduct($slug){
        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $product    = Product::select('products.id','image','price','sale','title','short_description','description',DB::raw('AVG(point) as rate'))
            ->leftJoin('rates','products.id','=','rates.product_id')
            ->where('slug',$slug)
            ->groupBy('image','price','title','sale','description','short_description','products.id')
            ->first();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();
        $ratePoint = 0;
        if(Auth::check()){
            $ratePoint  = App\Rate::where(['user_id' => Auth::user()->id, 'product_id' => $product->id])->first() != null?App\Rate::where(['user_id' => Auth::user()->id, 'product_id' => $product->id])->first()->point:0;
        }
        $comments   = App\Comment::where('product_id',$product->id)->get();
        return view('pages.product',compact('categories','product','bestSeller','taxonomies','comments','ratePoint'));
    }

    /**
    * Show single page
    *
    * @param string $slug
    * @return \Illuminate\Http\Response
    */
    public function showPage($slug){
        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $page       = App\Page::where('slug',$slug)->first();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();
        return view('pages.page',compact('categories','page','bestSeller','taxonomies'));
    }

    /**
    * Show listing of product in a category
    *
    * @param string $slug
    * @return \Illuminate\Http\Response
    */
    public function showCategory($slug){
        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();
        $category   = Category::where('slug',$slug)->first();
        $wishs = array();
        if(Auth::check()){
            $temp = WishList::where('user_id',Auth::user()->id)->get();
            foreach($temp as $val){
                $wishs[] = $val->product_id;
            }
        }

        return view('pages.category',compact('categories','taxonomies','bestSeller','category','wishs'));
    }

    /**
    * Show listing of post in a taxonomy
    *
    * @param string $slug
    * @return \Illuminate\Http\Response
    */
    public function showTaxonomy($slug){
        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $featured   = Post::select('title','image','slug')->where('featured',1)->inRandomOrder()->limit(5)->get();
        $taxonomy   = Taxonomy::where('slug',$slug)->first();
        return view('pages.taxonomy',compact('categories','taxonomies','taxonomy','featured'));
    }

    /**
    * Show posts
    *
    * @return \Illuminate\Http\Response
    */
    public function showPosts(){
        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $newPosts   = Post::select('title','image','sumary','posts.slug','name', 'taxonomies.slug AS alias')
            ->join('taxonomies','taxonomies.id','=','posts.taxonomy_id')
            ->orderBy('posts.id','DESC')
            ->limit(6)
            ->get();
        $fashions   = Taxonomy::with(['posts' => function($query){
            $query->limit(4)->orderBy('created_at','DESC');
        }])->where('id',3)->first();

        $quickNews  = Taxonomy::with(['posts' => function($query){
            $query->limit(4)->orderBy('created_at','DESC');
        }])->where('id',2)->first();

        $featured   = Post::select('title','image','slug')->where('featured',1)->inRandomOrder()->limit(5)->get();

        return view('pages.posts',compact('categories','newPosts','fashions','quickNews','featured','taxonomies'));
    }

    /**
    * Show single post
    *
    * @param string $slug
    * @return \Illuminate\Http\Response
    */
    public function showPost($slug){
        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $featured   = Post::select('title','image','slug')->where('featured',1)->inRandomOrder()->limit(5)->get();
        $post       = Post::where('slug',$slug)->first();
        $relates    = Post::select('title','image','slug')->where('taxonomy_id',$post->taxonomy_id)->where('slug','<>', $slug)->get();

        return view('pages.single',compact('categories','taxonomies','post','featured','relates'));
    }

    /**
    * Show contact page
    *
    * @return \Illuminate\Http\Response
    */
    public function contact(){
        $categories = Category::get();
        $taxonomies = Taxonomy::get();
        $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();

        return view('pages.contact',compact('categories','taxonomies','bestSeller'));
    }


    /**
    * Add product to wishlist
    *
    * @param \Illuminate\Http\Request $request
    * @return void
    */
    public function like(Request $request){
        if($request->active == '1'){
            $like = WishList::where(['user_id' => $request->userId, 'product_id' => $request->productId])->first();
            $like->delete();
        }else{
            $like = new WishList;
            $like->user_id    = $request->userId;
            $like->product_id = $request->productId;
            $like->save();
        }
    }

    /**
    * Store rating of product
    *
    * @param \Illuminate\Http\Request
    * @return int $avgPoint
    */
    public function rate(Request $request){
        if(App\Rate::where(['user_id' => $request->user_id, 'product_id' => $request->product_id])->count() > 0){
            $rate = App\Rate::where(['user_id' => $request->user_id, 'product_id' => $request->product_id])->first();
            $rate->point = $request->point;
            $rate->save();
        }else{
            $rate = new App\Rate;
            $rate->user_id    = $request->user_id;
            $rate->product_id = $request->product_id;
            $rate->point      = $request->point;
            $rate->save();
        }

        $avgPoint = App\Rate::select(DB::raw('IFNULL(AVG(point), 0) as point'))->where(['user_id' => $request->user_id, 'product_id' => $request->product_id])->first()->point;

        echo $avgPoint;
    }

    /**
    * Show liked list of product
    *
    * @return \Illuminate\Http\Response
    */
    public function wishList(){
        if(Auth::check()){
            $categories = Category::get();
            $taxonomies = Taxonomy::get();
            $bestSeller = Product::select('products.slug', 'image', 'price', 'sale', 'title', 'products.id')
            ->limit(5)
            ->orderBy('buy','DESC')
            ->get();
            $wishList   = Product::select('products.id','title','price','sale','image','slug')
                ->join('wish_lists','wish_lists.product_id','=','products.id')
                ->where('user_id',Auth::user()->id)
                ->get();
            return view('pages.wishlist',compact('categories','taxonomies','bestSeller','wishList'));
        }else{
            return redirect()->to('login');
        }
    }

    /**
    * Delete product from wishlist
    *
    * @param int $id
    * @return void
    */
    public function wishDelete($id){
        $item = WishList::where(['product_id' => $id, 'user_id' => Auth::user()->id])->first();

        $item->delete();
    }
}
