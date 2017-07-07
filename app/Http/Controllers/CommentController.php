<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class CommentController extends Controller
{

	public function index(){
		$breadcrumps = array(
		    0 => [ 'name' => 'Bình luận' ],
		);

		$comments = App\Comment::orderBy('id','DESC')->paginate(15);

		return view('admin.comments.index',compact('breadcrumps','comments'));
	}

    public function store(Request $request){
        $comment = new App\Comment;

        $comment->name       = $request->name;
        $comment->content    = $request->content;
        $comment->product_id = $request->productID;

        $comment->save();
        return $comment->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $comment = App\Comment::find($id);

        $comment->delete();
    }

    public function delete(Request $request){
        $id = $request->id;

        App\Comment::destroy($id);
    }
}
