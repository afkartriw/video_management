@extends('layouts.app')

@section('content')
    {{-- Page Breadcrumb --}}
    <x-common.page-breadcrumb pageTitle="Approved Video" />

    <div class="grid grid-cols-1 gap-5 sm:gap-6 xl:grid-cols-2">

        @foreach($data as $dt)
            <a href="{{ route('video.show', $dt->id_vid) }}"
            class="block rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] hover:shadow-lg transition">

                {{-- Judul --}}
                <div class="px-6 py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                        {{ $dt->judul_vid }}
                    </h3>
                </div>

                {{-- thumbnail --}}
                <div class="border-t border-gray-100 dark:border-gray-800 p-4 sm:p-6">
                    <div class="overflow-hidden rounded-lg aspect-video">
                        <img
                            src="{{ $dt->thumbnail_vid
                                ? asset('thumbnails/' . $dt->thumbnail_vid)
                                : asset('thumbnails/kosong.png') }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-800 px-6 py-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $dt->deskripsi_vid }}
                    </p>
                </div>

            </a>
        @endforeach

    </div>
@endsection