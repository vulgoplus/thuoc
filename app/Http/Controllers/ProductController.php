<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Image;
use File;
use Common;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Sản phẩm' ],
        );

        $products = Product::select('id','image','title','price','sale','featured','status')
            ->orderBy('id','DESC')
            ->paginate(10);
        $categories = Category::get();
        return view('admin.products.index',['breadcrumps' => $breadcrumps, 'products' => $products, 'categories' => $categories]);
    }

    public function filter(Request $request){
        if($request->title = '' && $request->category_id = 0){
            return redirect()->to('admin/products');
        }

        $title = $request->title;
        $category_id = $request->category_id;

        $products = null;

        if($title == ''){
            $products = Product::where('category_id',$request->category_id)->paginate(10);
        }elseif($category_id == 0){
            $products = Product::where('title','like', '%'.$title.'%')->paginate(10);
        }else{
            $products = Product::where('category_id',$request->category_id)->where('title','like', '%'.$title.'%')->paginate(10);
        }
        $categories = Category::get();
        $breadcrumps = array(
            0 => [ 'name' => 'Sản phẩm' ],
        );

        return view('admin.products.index',compact('breadcrumps','products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Sản phẩm', 'href' => url('admin/products') ],
            1 => [ 'name' => 'Thêm sản phẩm' ]
        );

        $categories = Category::orderBy('parent')->get();

        return view('admin.products.create',['categories' => $categories, 'breadcrumps' => $breadcrumps]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->manufacture = $request->manufacture;
        $product->price       = $request->price;
        $product->sale        = $request->sale!=''?$request->sale:0;
        $product->tags        = $request->tags;
        $product->slug        = $request->slug;

        //Upload image
        $image = $request->file('image');
        $imgName         = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('img/products/'.$imgName);
        $img             = Image::make($image->getRealPath());
        $img->resize(500, 500)->save($destinationPath);
        $product->image  = 'img/products/'.$imgName;

        //Upload if has multifile
        if($request->hasFile('images')){
            $images = array();
            foreach ($request->file('images') as $image) {
                $imgName         = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('img/products/'.$imgName);
                $img             = Image::make($image->getRealPath());
                $img->resize(500, 500)->save($destinationPath);
                $images[] = 'img/products/'.$imgName;
            }
            $product->images = json_encode($images);
        }

        $product->save();

        return redirect()->to('admin/products')->with('success','Sản phẩm đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Sản phẩm', 'href' => url('admin/products') ],
            1 => [ 'name' => 'Cập nhật sản phẩm' ]
        );

        $categories = Category::get();
        $product    = Product::find($id);

        return view('admin.products.edit',['categories' => $categories, 'breadcrumps' => $breadcrumps, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->manufacture = $request->manufacture;
        $product->price       = $request->price;
        $product->sale        = $request->sale!=''?$request->sale:0;
        $product->tags        = $request->tags;
        $product->slug        = $request->slug;

        //Upload image
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imgName         = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('img/products/'.$imgName);
            $img             = Image::make($image->getRealPath());
            $img->resize(500, 500)->save($destinationPath);
            File::delete(public_path($product->image));
            $product->image  = 'img/products/'.$imgName;
        }

        //Upload if has multifile
        if($request->hasFile('images')){
            $images = json_decode($product->images);
            if(count($images) > 0){
                foreach ($images as $image) {
                    File::delete(public_path($image));
                }
            }
            $images = array();
            foreach ($request->file('images') as $image) {
                $imgName         = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('img/products/'.$imgName);
                $img             = Image::make($image->getRealPath());
                $img->resize(500, 500)->save($destinationPath);
                $images[] = 'img/products/'.$imgName;
            }
            $product->images = json_encode($images);
        }

        $product->save();

        return redirect()->to('admin/products/'.$id.'/edit')->with('success','Sản phẩm đã được thêm thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        File::delete(public_path($product->image));
        $images = json_decode($product->images);
        if(count($images) > 0){
            foreach ($images as $image) {
                File::delete(public_path($image));
            }
        }
        $product->delete();
    }

    public function delete(Request $request){
        $id = $request->id;
        Product::destroy($id);
    }

    /**
    * Create product slug
    *
    * @param \Illuminate\Http\Request
    * @return string
    */
    public function createSlug(Request $request){
        $i = 0;
        $slug = Common::createAlias($request->slug);
        while(Product::where('slug',$slug)->count() > 0){
            if($i != 0){
                $slug = $slug.'-'.$i;
            }
            $i++;
        }
        echo $slug;
    }

    /**
    * Change products featured
    *
    * @return none
    */
    public function featured(Request $request, $id){
        $product = Product::find($id);
        $product->featured = $request->status;
        $product->save();
    }
}
