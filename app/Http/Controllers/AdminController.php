<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Quản trị viên' ],
        );

        $users = Admin::orderBy('id','DESC')->paginate(10);

        return view('admin.admins.index', ['breadcrumps' => $breadcrumps, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumps = array(
            0 => [ 'name' => 'Quản trị viên', 'href' => url('admin/admins') ],
            1 => [ 'name' => 'Thêm quản trị viên' ]
        );

        return view('admin.admins.create',['breadcrumps' => $breadcrumps]);
    }

    public function changePassword(Request $request){
        $this->validate($request,[
            'password' => 'required|same:password_confirmed'
        ],[
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.same'     => 'Mật khẩu không khớp!'
        ]);

        $user = Admin::find($request->id);
        $user->password = bcrypt($request->password);

        $user->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new Admin;

        $user->name     = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email    = $request->email;

        $user->save();

        return redirect()->to('admin/admins')->with('success', 'Đã thêm quản trị viên!');
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
        $user = User::find($id);

        $user->delete();
    }
}
