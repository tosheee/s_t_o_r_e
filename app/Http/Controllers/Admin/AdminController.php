<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index')->with('users', $admins)->with('title', 'All Admins');
    }

    public function create()
    {
        $admins = Admin::all();
        return view('admin.admins.create')->with('users', $admins)->with('title', 'Create Admin');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email'        => 'required',
            'password'  => 'required',
        ]);
        // Create Category

        $admin = new Admin;
        $admin->category_id = $request->input('category_id');
        $admin->name        = $request->input('name');
        $admin->identifier  = $request->input('identifier');
        $admin->save();

        return redirect('admin/admins');
    }

    public function show($id)
    {
        $admin = Admin::find($id);

        return view('admin.admins.show')->with('admin', $admin);
    }

    public function edit($id)
    {
        $admin = Admin::find($id);

        return view('admin.admins.edit')->with('admin', $admin);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email'        => 'required',
            'password'  => 'required',
        ]);

        $admin =  Admin::find($id);
        $admin->category_id = $request->input('category_id');
        $admin->name        = $request->input('name');
        $admin->identifier  = $request->input('identifier');
        $admin->save();

        return redirect('admin/admins');
    }

    public function destroy($id)
    {
        $admin =  Admin::find($id);
        $admin->delete();
        return redirect('admin/admins')->with('succes', 'Admin Removed');
    }
}
