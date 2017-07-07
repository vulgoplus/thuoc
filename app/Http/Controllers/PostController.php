<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taxonomy;
use App\Post;
use Common;
use Image;
use File;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Bài viết' ],
        );

        $posts = Post::select('id','title','created_at')->orderBy('id','DESC')->paginate(10);
        return view('admin.posts.index',['breadcrumps' => $breadcrumps, 'posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Bài viết', 'href' => url('admin/posts') ],
            1 => [ 'name' => 'Thêm bài viết' ]
        );

        $taxonomies = Taxonomy::get();

        return view('admin.posts.create',['breadcrumps' => $breadcrumps, 'taxonomies' => $taxonomies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $post = new Post;

        $post->title       = $request->title;
        $post->content     = $request->content;
        $post->sumary      = Common::createSumary($request->content,200);
        $post->taxonomy_id = $request->taxonomy_id;
        $post->tags        = $request->tags;
        $post->slug        = $request->slug;

        //Upload image
        $image = $request->file('image');
        $imgName         = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('img/posts/'.$imgName);
        $img             = Image::make($image->getRealPath());
        $img->resize(500, 500)->save($destinationPath);
        $post->image  = 'img/posts/'.$imgName;

        $post->save();

        return redirect()->to('admin/posts')->with('success','Bài viết đã được thêm thành công!');
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
            0 => [ 'name' => 'Bài viết', 'href' => url('admin/posts') ],
            1 => [ 'name' => 'Thêm bài viết' ]
        );

        $taxonomies = Taxonomy::get();
        $post       = Post::find($id);

        return view('admin.posts.edit',['breadcrumps' => $breadcrumps, 'taxonomies' => $taxonomies, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePost $request, $id)
    {
        $post = Post::find($id);

        $post->title       = $request->title;
        $post->content     = $request->content;
        $post->sumary      = Common::createSumary($request->content,200);
        $post->taxonomy_id = $request->taxonomy_id;
        $post->tags        = $request->tags;
        $post->slug        = $request->slug;

        //Upload image
        if($request->hasFile('image')){
            File::delete(public_path($post->image));
            $image = $request->file('image');
            $imgName         = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('img/posts/'.$imgName);
            $img             = Image::make($image->getRealPath());
            $img->resize(500, 500)->save($destinationPath);
            $post->image  = 'img/posts/'.$imgName;
        }

        $post->save();

        return redirect()->to('admin/posts/'.$id.'/edit')->with('success','Bài viết đã được chỉnh sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        File::delete(public_path($post->image));

        $post->delete();
    }

    /**
    * Create post slug
    *
    * @param \Illuminate\Http\Request
    * @return string
    */
    public function createSlug(Request $request){
        $i = 0;
        $slug = Common::createAlias($request->slug);
        if($request->has('id')){
            while(Post::where('slug',$slug)->where('id','<>',$request->id)->count() > 0){
                if($i != 0){
                    $slug = $slug.'-'.$i;
                }
                $i++;
            }
        }else{
            while(Post::where('slug',$slug)->count() > 0){
                if($i != 0){
                    $slug = $slug.'-'.$i;
                }
                $i++;
            }
        }
        echo $slug;
    }

    /**
    * Change products featured
    *
    * @return none
    */
    public function featured(Request $request, $id){
        $post = Post::find($id);
        $post->featured = $request->status;
        $post->save();
    }
}
