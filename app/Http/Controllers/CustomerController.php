<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
   public function index()
    {
        $data = DB::table('users')->where('role', 'customer')->get();
        
        return view('pages.admin.customer', compact('data'));
    }

    public function store(Request $request)
    {
        if($request->cek == 'add'){
            DB::table('users')->insert([
                'username' => $request->username,
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'password_asli' => $request->password,
                'role' => 'customer',
                'status_users' => $request->status_users,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if($request->cek == 'edit'){
            DB::table('users')->where('id_users',$request->id_users)->update([
                'username' => $request->username,
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'password_asli' => $request->password,
                'role' => 'customer',
                'status_users' => $request->status_users,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return back()->with('success', 'Customer berhasil ditambahkan');
    }

    public function update(Request $request, User $customer)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $customer->id,
            'name' => 'required',
            'password' => 'nullable|min:6',
        ]);

        $customer->update([
            'username' => $request->username,
            'name' => $request->name,
            'password' => $request->password ? bcrypt($request->password) : $customer->password,
        ]);

        return back()->with('success', 'Customer berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id_users', $id)->delete();

        return back()->with('success', 'Customer berhasil dihapus');
    }
}