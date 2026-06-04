@extends('layouts.app')

@section('content')
{{-- Page Breadcrumb --}}
<x-common.page-breadcrumb pageTitle="Videos" />

<div class="grid grid-cols-1 gap-5 sm:gap-6 xl:grid-cols-2">

    @foreach($video as $dt)
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

            {{-- Judul + Tombol --}}
            <div class="px-6 py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    {{ $dt->judul_vid }}
                </h3>

                <button
                    type="button"
                    class="buka_modal inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600"
                    data-id="{{ $dt->id_vid }}"
                    data-judul="{{ $dt->judul_vid }}"
                    data-deskripsi="{{ $dt->deskripsi_vid }}"
                    data-thumbnail="{{ $dt->thumbnail_vid }}">
                    Request
                </button>
            </div>

            {{-- thumbnail --}}
            <div class="border-t border-gray-100 dark:border-gray-800 p-4 sm:p-6">
                <div class="overflow-hidden rounded-lg aspect-video">
                    <img
                        src="{{ $dt->thumbnail_vid
                                ? asset('thumbnails/' . $dt->thumbnail_vid)
                                : asset('thumbnails/kosong.png') }}"
                        alt="{{ $dt->judul_vid }}"
                        class="w-full h-full object-cover"
                    >
                </div>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-800 px-6 py-4">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $dt->deskripsi_vid }}
                </p>
            </div>

        </div>
    @endforeach

</div>

<div id="view_video" class="hidden fixed inset-0 z-[999999] flex items-center justify-center bg-black/50">
    <div class="w-full max-w-lg rounded-xl bg-white p-6 dark:bg-gray-900">
      
        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white/90">Requeust Video</h3>
            <button type="button" class="close text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form method="POST" action="{{ route('request.store') }}">
            @csrf
            <div class="space-y-5">

                <div class="flex justify-center">
                    <img id="previewThumbnail"
                        src=""
                        class="hidden w-full max-w-md h-40 object-cover rounded-lg shadow"
                        alt="Thumbnail">
                </div>
               
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Judul Video
                    </label>
                    <input type="text" id="judul" readonly class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                </div>
                  
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Deskripsi Video
                    </label>
                    <input type="text" id="deskripsi_video" readonly class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Pesan Customer
                    </label>

                    <textarea
                        name="pesan_req"
                        id="pesan_req"
                        required
                        class="h-24 w-full rounded-lg border  px-4 py-2.5 text-sm dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300 bg-transparent text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                </div>     

            </div>

            <!-- Modal Footer Buttons -->             
            <div class="mt-6 flex justify-end gap-3" id="batal_simpan">
                <button type="button" class="close rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                    Batal
                </button>         
                <input type="hidden" name="id_vid_req" id="id_vid_req">                 
                <input type="hidden" name="action" value="add">                 
                <button type="submit" 
                    class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>    
@endsection

@push('scripts')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endpush