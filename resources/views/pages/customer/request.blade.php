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
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>    


@endsection

@push('scripts')
    <script src="{{ asset('js/video.js') }}"></script>
@endpush