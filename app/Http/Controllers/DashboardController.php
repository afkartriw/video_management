<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        if (auth()->user()->role == 'admin') {
            $customerCount = DB::table('users')->where('role', 'customer')->count();
            $videoCount = DB::table('video')->count();
            $request = DB::table('request')->join('users','id_users','id_cus_req')->join('video','id_vid','id_vid_req')->get();

            return view('pages.admin.dashboard', ['title' => 'E-commerce Dashboard', 'customerCount' => $customerCount, 'videoCount' => $videoCount, 'request' => $request]);
        } elseif (auth()->user()->role == 'customer') {

           $acc = DB::table('video')
                ->join('request', 'video.id_vid', '=', 'request.id_vid_req')
                ->join('users', 'users.id_users', '=', 'request.id_cus_req')
                ->whereIn('request.status_req', ['acc', 'pending'])
                ->where('users.id_users', auth()->user()->id_users)
                ->pluck('video.id_vid'); // ambil list id video saja

            $video = DB::table('video')
                ->where('status_vid', 'aktif')
                ->whereNotIn('id_vid', $acc)
                ->get();
            return view('pages.customer.dashboard', ['title' => 'E-commerce Dashboard','video' => $video]);
        } else {
            return view('/logout');
        }
    }
}
