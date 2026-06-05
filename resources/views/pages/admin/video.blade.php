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
          <button class="buka_modal inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600 " data-cek="add">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah {{ $menu }}
          </button>
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
                        <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Judul</th>
                        <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Deskripsi</th>
                        <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">link</th>
                        <th scope="col" class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Tanggal Upload</th>
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
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $dt->judul_vid }}</div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ \Illuminate\Support\Str::limit($dt->deskripsi_vid, 50, '...') }}
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $dt->link_vid }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $dt->tanggal_vid }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $dt->status_vid }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center gap-3">
                                <!-- View -->
                                <button type="button" class="text-blue-500 hover:text-blue-700 buka_modal" data-cek="detail" data-cek="detail" data-id="{{ $dt->id_vid }}" data-judul="{{ $dt->judul_vid }}" data-deskripsi="{{ $dt->deskripsi_vid }}" data-link="{{ $dt->link_vid }}" data-thumbnail="{{ $dt->thumbnail_vid }}" data-tanggal="{{ $dt->tanggal_vid }}" data-status="{{ $dt->status_vid }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>

                                <!-- Edit -->
                                <button type="button" class="text-yellow-500 hover:text-yellow-700 buka_modal"  data-cek="edit" data-id="{{ $dt->id_vid }}" data-judul="{{ $dt->judul_vid }}" data-deskripsi="{{ $dt->deskripsi_vid }}" data-link="{{ $dt->link_vid }}" data-thumbnail="{{ $dt->thumbnail_vid }}"  data-tanggal="{{ $dt->tanggal_vid }}" data-status="{{ $dt->status_vid }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 15l-4 1 1-4 9.586-9.586z"/>
                                    </svg>
                                </button>

                                <!-- Delete -->
                                <form method="POST" action="{{ route('video.destroy', $dt->id_vid) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>    

<div id="view_video" class="hidden fixed inset-0 z-[999999] bg-black/50 overflow-y-auto">
    <div class="min-h-full flex items-start justify-center p-6">
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
                <form method="POST" action="{{ route('video.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-5">
                        <!-- Name Input -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Judul
                            </label>
                            <input type="text" name="judul" id="judul" placeholder="Masukkan nama lengkap" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>

                        <!-- Username Input -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan username"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-24 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" ></textarea>
                        </div>

                       <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Thumbnail Video
                            </label>

                            <input type="file" name="thumbnail" id="thumbnail"
                                accept="image/*"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>

                        <div class="mt-3 flex justify-center relative">
                            <button type="button" id="removeThumbnail"
                                class="hidden absolute -top-2 -right-2 bg-gray-600 text-white rounded-full w-7 h-7">
                                ✕
                            </button>

                            <img id="previewThumbnail"
                                class="hidden w-80 h-40 object-cover rounded-lg shadow"
                                alt="Thumbnail Preview">
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Upload Video
                            </label>
                            <input type="file" name="video" id="video"
                                accept="video/*"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>    
                        <!-- Preview -->
                        <div class="mt-3 flex justify-center relative">    
                            <!-- Tombol X -->
                            <button type="button" id="removeVideo" class="hidden absolute -top-2 -right-2 bg-gray-600 text-white rounded-full w-7 h-7 flex items-center justify-center">
                                ✕
                            </button>

                            <!-- Video Preview -->
                            <video id="previewVideo"
                                controls
                                class="w-80 h-40 hidden rounded-lg shadow">
                            </video>
                        </div>

                        
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Status
                            </label>
                            <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                <select name="status_vid" id="status"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'" 
                                    @change="isOptionSelected = true">
                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400" disabled>
                                        Pilih Status
                                    </option>
                                    <option value="aktif" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Aktif
                                    </option>
                                    <option value="non_aktif" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Non Aktif
                                    </option>
                                </select>
                                <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id_vid"id="id_vid"/>              
                    <input type="hidden" name="cek"id="cek"/>    

                    <!-- Modal Footer Buttons -->
                    <div class="mt-6 flex justify-end gap-3" id="batal_simpan">
                        <button type="button" class="close rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                            Batal
                        </button>          
                        <button type="submit" 
                            class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/video.js') }}"></script>
@endpush
