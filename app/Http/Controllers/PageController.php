<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Common;
use App\Http\Requests\StorePage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Trang' ],
        );
        $pages = Page::orderBy('id','DESC')->paginate(10);

        return view('admin.pages.index',['breadcrumps' => $breadcrumps, 'pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Trang', 'href' => url('admin/pages') ],
            1 => [ 'name' => 'Thêm trang' ]
        );

        return view('admin.pages.create',['breadcrumps' => $breadcrumps]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePage $request)
    {
        $page = new Page;
        $page->title   = $request->title;
        $page->content = $request->content;

        $slug = Common::createAlias($request->title);
        while(Page::where('slug',$slug)->count() > 0){
            if($i != 0){
                $slug = $slug.'-'.$i;
            }
            $i++;
        }
        $page->slug   = $slug;
        $page->save();

        return redirect()->to('admin/pages')->with('success','Trang được thêm thành công!');
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
            0 => [ 'name' => 'Trang', 'href' => url('admin/pages') ],
            1 => [ 'name' => 'Cập nhật trang' ]
        );

        $page = Page::find($id);

        return view('admin.pages.edit',['page' => $page, 'breadcrumps' => $breadcrumps]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePage $request, $id)
    {
        $page = Page::find($id);

        $page->title   = $request->title;
        $page->content = $request->content;

        $slug = Common::createAlias($request->title);
        $i = 0;
        while(Page::where('slug',$slug)->count() > 0){
            if($i != 0){
                $slug = $slug.'-'.$i;
            }
            $i++;
        }
        $page->slug   = $slug;
        $page->save();

        return redirect()->to('admin/pages/'.$id.'/edit')->with('success','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        $page->delete();
    }

    public function delete(Request $request){
        $id = $request->id;

        Page::destroy($id);
        echo "Deleted!";
    }
}
