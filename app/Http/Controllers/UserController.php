<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Thành viên' ],
        );

        $users = User::select('id','username','provider','email','name')->orderBy('id','DESC')->paginate(10);
        return view('admin.users.index', ['users' => $users, 'breadcrumps' => $breadcrumps]);
    }

    /**
    * Change Password
    *
    * @return void
    */
    public function changePassword(Request $request){
        $this->validate($request,[
            'password' => 'required|same:password_confirmed'
        ],[
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.same'     => 'Mật khẩu không khớp'
        ]);

        $user = User::find($request->id);
        $user->password = bcrypt($request->password);

        $user->save();
    }

    /**
    * Increment Balance
    *
    * @return void
    */
    public function incrementBalance(Request $request){
        $this->validate($request, [
            'balance' => 'required|numeric'
        ],[
            'balance.required' => 'Vui lòng nhập số liệu!',
            'balance.numeric'  => 'Vui lòng nhập số!'
        ]);

        $user = User::find($request->id);

        $user->balance += $request->balance;

        $user->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "<h3>Forbiden</h3>";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo "<h3>Forbiden</h3>";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "<h3>Forbiden</h3>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "<h3>Forbiden</h3>";
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
        echo "<h3>Forbiden</h3>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
    }
}
