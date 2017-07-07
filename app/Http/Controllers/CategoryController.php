<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Common;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Danh mục' ],
        );
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view('admin.categories.index',['categories' => $categories, 'breadcrumps' => $breadcrumps]);
    }


    public function add(Request $request){
        $category = new Category;
        $category->name   = $request->name;
        $category->parent = $request->parent;
        $slug = Common::createAlias($request->name);

        //Identity Alias
        $i = 0;
        while(Category::where('slug',$slug)->count() > 0){
            if($i != 0){
                $slug = $slug.'-'.$i;
            }
            $i++;
        }

        $category->slug = $slug;
        $category->save();

        $response = array( 'name' => $request->name, 'id' => $category->id );
        echo json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Danh mục', 'href' => url('admin/categories') ],
            1 => [ 'name' => 'Thêm danh mục' ]
        );

        return view('admin.categories.create',['breadcrumps' => $breadcrumps]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name   = $request->name;
        $category->parent = $request->parent;
        $slug = Common::createAlias($request->name);

        //Identity Alias
        $i = 0;
        while(Category::where('slug',$slug)->count() > 0){
            if($i != 0){
                $slug = $slug.'-'.$i;
            }
            $i++;
        }

        $category->slug = $slug;
        $category->save();

        return redirect()->to('admin/categories')->with('success','Danh mục đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Empty
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
            0 => [ 'name' => 'Danh mục', 'href' => url('admin/categories') ],
            1 => [ 'name' => 'Cập nhật danh mục' ]
        );

        $category = Category::find($id);
        return view('admin.categories.edit',['breadcrumps' => $breadcrumps, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $category->name   = $request->name;
        $category->parent = $request->parent;
        $slug = Common::createAlias($request->name);

        //Identity Alias
        $i = 0;
        while(Category::where('slug',$slug)->count() > 0){
            if($i != 0){
                $slug = $slug.'-'.$i;
            }
            $i++;
        }

        $category->slug = $slug;
        $category->save();

        return redirect()->to('admin/categories/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $category = Category::find($id);

        $category->delete();
    }

    public function delete(Request $request){
        $id = $request->id;

        Category::destroy($id);
    }
}
