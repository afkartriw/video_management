<?php 
    $menu = ucwords(str_replace('_', ' ', request()->segment(1)));
?> 

@extends('layouts.app')

@section('content')        

<div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <!-- Header -->
  <div class="p-6">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            {{ $menu }}
        </h2>
    </div>

    <!-- Action Bar -->
    <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
        <div>
        </div>

        <!-- Search -->
        <div class="w-full md:w-80">
            <form method="GET">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari ...." class="w-full py-2 pl-4 pr-10 border border-gray-300 rounded-lg dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Table -->
    <div class="overflow-hidden">
        <div class="max-w-full px-5 overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-gray-200 border-y dark:border-gray-700">
                        <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Customer</th>
                        <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Thumbnail Video</th>
                        <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Judul Video</th>
                        <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Tanggal Request</th>
                        <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Pesan Customer</th>
                        <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Status</th>
                        <th scope="col" class="relative px-4 py-3 capitalize">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                  @foreach($data as $i => $dt)
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $dt->name }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <img
                                src="{{ asset('thumbnails/'.$dt->thumbnail_vid) }}"
                                alt="{{ $dt->judul_vid }}"
                                class="w-20 h-12 object-cover rounded">
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $dt->judul_vid }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $dt->tanggal_req }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $dt->pesan_req }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $dt->status_req }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center gap-3">
                                
                                <button type="button"
                                    class="buka_modal text-blue-500 hover:text-blue-700"
                                    data-id="{{ $dt->id_req }}"
                                    data-judul="{{ $dt->judul_vid }}"
                                    data-deskripsi="{{ $dt->deskripsi_vid }}"
                                    data-pesan="{{ $dt->pesan_req }}"
                                    data-status="{{ $dt->status_req }}"
                                    data-mulai="{{ $dt->mulai_akses_req }}"
                                    data-selesai="{{ $dt->selesai_akses_req }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 15l-4 1 1-4 9.586-9.586z"/>
                                    </svg>
                                </button>

                            </div>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>    

<div id="view_video" class="hidden fixed inset-0 z-[999999] flex items-center justify-center bg-black/50">
    <div class="w-full max-w-lg rounded-xl bg-white p-6 dark:bg-gray-900">
        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white/90" id="modal_title"></h3>
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

                {{-- THUMBNAIL --}}
                <div class="flex justify-center">
                    <img id="previewThumbnail"
                        class="hidden w-full max-w-md h-52 object-cover rounded-lg shadow">
                </div>

                {{-- JUDUL --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Judul Video</label>
                    <input type="text" id="judul" readonly
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Deskripsi Video</label>
                    <input type="text" id="deskripsi" readonly
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                </div>

                {{-- PESAN --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Pesan Customer</label>
                    <textarea id="pesan" readonly
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" ></textarea>
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                    <select name="status_req" id="status_req"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" >
                        <option value="pending">Pending</option>
                        <option value="acc">ACC</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                {{-- AKSES (HANYA MUNCUL JIKA ACC) --}}
                <div id="akses_box" class="hidden space-y-3">

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Mulai Akses</label>
                        <input type="datetime-local" name="mulai_akses_req" id="mulai"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Selesai Akses</label>
                        <input type="datetime-local" name="selesai_akses_req" id="selesai"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>

                </div>

            </div>

            <div class="mt-6 flex justify-end gap-3" id="batal_simpan">
                <button type="button" class="close rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                    Batal
                </button>          
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id_req" id="id_req">

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
    <script src="{{ asset('js/request.js') }}"></script>
@endpush