<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taxonomy;
use Common;

class TaxonomyController extends Controller
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
        $taxonomies = Taxonomy::orderBy('id','DESC')->paginate(10);
        return view('admin.taxonomies.index',['taxonomies' => $taxonomies, 'breadcrumps' => $breadcrumps]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Danh mục', 'href' => url('admin/taxonomies') ],
            1 => [ 'name' => 'Thêm danh mục' ]
        );

        return view('admin.taxonomies.create',['breadcrumps' => $breadcrumps]);
    }

    /**
    * Store resoure using AJAX
    *
    * @return JSON
    */
    public function add(Request $request){
        $taxonomy = new Taxonomy;
        $taxonomy->name   = $request->name;
        $slug = Common::createAlias($request->name);

        //Identity Alias
        $i = 0;
        while(Taxonomy::where('slug',$slug)->count() > 0){
            if($i != 0){
                $slug = $slug.'-'.$i;
            }
            $i++;
        }

        $taxonomy->slug = $slug;
        $taxonomy->save();

        $response = array( 'name' => $request->name, 'id' => $taxonomy->id );
        echo json_encode($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên!'
        ]);

        $taxonomy        = new Taxonomy;
        $taxonomy->name  = $request->name;
        $slug = Common::createAlias($request->name);

        //Identity Alias
        $i = 0;
        while(Taxonomy::where('slug',$slug)->count() > 0){
            if($i != 0){
                $slug = $slug.'-'.$i;
            }
            $i++;
        }

        $taxonomy->slug = $slug;
        $taxonomy->save();

        return redirect()->to('admin/taxonomies')->with('success','Danh mục đã được thêm thành công!');
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
            0 => [ 'name' => 'Danh mục', 'href' => url('admin/taxonomies') ],
            1 => [ 'name' => 'Cập nhật danh mục' ]
        );

        $taxonomy = Taxonomy::find($id);
        return view('admin.taxonomies.edit',['breadcrumps' => $breadcrumps, 'taxonomy' => $taxonomy]);
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
        $this->validate($request, [
            'name' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên!'
        ]);
        
        $taxonomy = Taxonomy::find($id);

        $taxonomy->name   = $request->name;
        $slug = Common::createAlias($request->name);

        //Identity Alias
        $i = 0;
        while(Taxonomy::where('slug',$slug)->count() > 0){
            if($i != 0){
                $slug = $slug.'-'.$i;
            }
            $i++;
        }

        $taxonomy->slug = $slug;
        $taxonomy->save();

        return redirect()->to('admin/taxonomies/'.$id.'/edit')->with('success','Đã cập nhật danh mục!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;

        Taxonomy::destroy($id);
    }
}
