<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;

class FeedbackController extends Controller
{

	public function index(){
		$breadcrumps = array(
		    0 => [ 'name' => 'Phản hồi' ],
		);
		$feedbacks = Feedback::orderBy('id','DESC')->paginate(10);

		return view('admin.feedback.index', compact('breadcrumps','feedbacks'));
	}

    public function store(Request $request){
    	$feedback = new Feedback;

    	$feedback->name    = $request->name;
    	$feedback->email   = $request->email;
    	$feedback->content = $request->content;

    	$feedback->save();

    	return redirect()->to('/')->with('success','Phản hồi của bạn đã được gửi đi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $feedback = Feedback::find($id);

        $feedback->delete();
    }

    public function delete(Request $request){
        $id = $request->id;

        Feedback::destroy($id);
    }
}
