<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VideoController extends Controller
{
    public function index()
    {

        DB::table('request')->where('status_req', 'acc')->where('selesai_akses_req', '<', Carbon::now())->update(['status_req' => 'expaide']);    


        if (auth()->user()->role == 'admin') {

            $data = DB::table('video')->get();

            return view('pages.admin.video', ['title' => 'Video', 'data' => $data]);

        } elseif (auth()->user()->role == 'customer') {
            
            $data = DB::table('video')->join('request','id_vid','id_vid_req')->where('mulai_akses_req', '<', Carbon::now())->join('users','id_users','id_cus_req')->where('status_req','acc')->where('id_users',auth()->user()->id_users)->get();

            return view('pages.customer.video', ['title' => 'Video', 'data' => $data]);

        } 
        
    }

    public function show($id)
    {

        $video = DB::table('video')->where('id_vid', $id)->join('request','id_vid','id_vid_req')->join('users','id_users','id_cus_req')->where('status_req','acc')->where('mulai_akses_req', '<', Carbon::now())->where('id_users',auth()->user()->id_users)->first();

        if($video == null){
            return redirect()->route('video.index')->with('error', 'Video tidak ditemukan atau tidak diizinkan.');
        }

        $komentar = DB::table('video_detail')
            ->join('users', 'users.id_users', '=', 'video_detail.id_cus_vid_dt')
            ->where('id_vid_vid_dt', $id)
            ->whereNotNull('komen_vid_dt')
            ->select(
                'video_detail.*',
                'users.name'
            )
            ->latest()
            ->get();

        $totalLike = DB::table('video_detail')
            ->where('id_vid_vid_dt', $id)
            ->sum('like_vid_dt');

        $totalDislike = DB::table('video_detail')
            ->where('id_vid_vid_dt', $id)
            ->sum('dislike_vid_dt');

        return view('pages.customer.video_detail', compact('video','totalLike','totalDislike','komentar'));
    }

    public function store(Request $request)
    {
        if($request->action == 'komen'){
            DB::table('video_detail')->insert([
                'id_vid_vid_dt' => $request->id_vid,
                'id_cus_vid_dt' => auth()->id(),
                'komen_vid_dt' => $request->komentar,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if($request->action == 'react'){
            $cek = DB::table('video_detail')
                    ->where('id_vid_vid_dt', $request->id_vid)
                    ->where('id_cus_vid_dt', auth()->id())
                    ->first();

            if (!$cek) {

                DB::table('video_detail')->insert([
                    'id_vid_vid_dt' => $request->id_vid,
                    'id_cus_vid_dt' => auth()->id(),
                    'like_vid_dt' => $request->tipe == 'like' ? 1 : 0,
                    'dislike_vid_dt' => $request->tipe == 'dislike' ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            } else {

                DB::table('video_detail')
                    ->where('id_vid_dt', $cek->id_vid_dt)
                    ->update([
                        'like_vid_dt' => $request->tipe == 'like' ? 1 : 0,
                        'dislike_vid_dt' => $request->tipe == 'dislike' ? 1 : 0,
                        'updated_at' => now(),
                    ]);
            }

            return back();
        }        

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = [
            'judul_vid' => $request->judul,
            'deskripsi_vid' => $request->deskripsi,
            'status_vid' => $request->status_vid,
            'updated_at' => now(),
        ];

        // Upload Video jika ada
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = time().'_video.'.$video->getClientOriginalExtension();
            $video->move(public_path('videos'), $videoName);
            $data['link_vid'] = $videoName;
        }

        // Upload Thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time().'_thumbnail.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('thumbnails'), $thumbnailName);
            $data['thumbnail_vid'] = $thumbnailName;
        }

        // ADD
        if ($request->cek == 'add') {
            $data['tanggal_vid'] = date('Y-m-d');
            $data['created_at'] = now();

            DB::table('video')->insert($data);

            return back()->with('success', 'Video berhasil ditambahkan');
        }

        // EDIT
        if ($request->cek == 'edit') {

            DB::table('video')->where('id_vid', $request->id_vid)->update($data);

            return back()->with('success', 'Video berhasil diperbarui');
        }

        return back()->with('error', 'Aksi tidak dikenali');
    }


    public function destroy(string $id)
    {
        DB::table('video')->where('id_vid', $id)->delete();

        return back()->with('success', 'Customer berhasil dihapus');
    }
}