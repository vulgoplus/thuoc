<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\SliderImage;
use Image;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Slider' ],
        );

        $sliders = Slider::select('id','name')->paginate(10);

        return view('admin.sliders.index',['breadcrumps' => $breadcrumps,'sliders' => $sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo '<h3>Forbiden</h3>';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider       = new Slider;
        $slider->name = $request->name;
        $slider->save();

        return redirect()->to('admin/sliders')->with('success','Đã thêm!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeImage(Request $request){
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg'
        ], [
            'image.required' => 'Ảnh là bắt buộc!',
            'image.mimes'    => 'Ảnh sai định dạng!'
        ]);

        $i            = new SliderImage;
        $i->text      = $request->text;
        $i->link      = $request->link;
        $i->slider_id = $request->id;

        //Upload image
        $image = $request->file('image');
        $imgName         = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('img/sliders/'.$imgName);
        $img             = Image::make($image->getRealPath());
        $img->save($destinationPath);
        $i->image  = 'img/sliders/'.$imgName;

        $i->save();

        return redirect()->to('admin/sliders/'.$request->id)->with('success','Lưu thành công!');
    }

    public function deleteImage($id){
        $i = SliderImage::find($id);

        File::delete(public_path($i->image));
        $i->delete();
    }

    public function updateImage(Request $request){
        $i = SliderImage::find($request->id);

        $i->text = $request->text;
        $i->link = $request->link;
        if($request->hasFile('image')){
            //Upload image
            $image = $request->file('image');
            $imgName         = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('img/sliders/'.$imgName);
            $img             = Image::make($image->getRealPath());
            $img->save($destinationPath);
            File::delete(public_path($i->image));
            $i->image  = 'img/sliders/'.$imgName;
        }

        $i->save();
        return redirect()->to('admin/sliders/'.$request->slider_id)->with('success','Lưu thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Slider', 'href' => url('admin/sliders') ],
            1 => [ 'name' => 'Hình ảnh' ]
        );

        $slider = Slider::find($id);
        $images = SliderImage::where('slider_id',$id)->get();

        return view('admin.sliders.edit',['breadcrumps' => $breadcrumps, 'slider' => $slider, 'images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo '<h3>Forbiden</h3>';
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
        echo '<h3>Forbiden</h3>';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);

        $slider->delete();
    }
}
