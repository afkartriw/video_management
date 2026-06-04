<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {

        if (auth()->user()->role == 'admin') {

            $data = DB::table('request')->join('users','id_users','id_cus_req')->join('video','id_vid','id_vid_req')->get();

            return view('pages.admin.request',compact('data'));      
        } elseif (auth()->user()->role == 'customer') {

            $data = DB::table('request')->join('users','id_users','id_cus_req')->join('video','id_vid','id_vid_req')->where('id_users',auth()->user()->id_users)->get();

            return view('pages.customer.request',compact('data'));         
        }
    }

    public function store(Request $request)
    {
        if($request->action == 'edit'){

            DB::table('request')->where('id_req',$request->id_req)->update([
                'status_req' => $request->status_req,
                'mulai_akses_req' => $request->mulai_akses_req,
                'selesai_akses_req' => $request->selesai_akses_req,
                'updated_at' => now(),
            ]);
        }
        
        if($request->action == 'add'){

            $request->validate([
                'id_vid_req' => 'required',
            ]);

            DB::table('request')->insert([
                'id_vid_req' => $request->id_vid_req,
                'id_cus_req' => auth()->user()->id_users,
                'pesan_req' => $request->pesan_req,
                'tanggal_req' => date('Y-m-d'),
                'status_req' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return back()->with('success', 'Request berhasil dikirim');
    }

    public function destroy(string $id)
    {
        //
    }
}