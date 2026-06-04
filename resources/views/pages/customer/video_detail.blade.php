@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

    {{-- BACK BUTTON --}}
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
        ← Kembali
    </a>

    {{-- VIDEO CARD --}}
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden">

        {{-- VIDEO PLAYER --}}
        <div class="aspect-video bg-black">
            @if($video && $video->link_vid)
                <video controls class="w-full h-full">
                    <source src="{{ asset('videos/' . $video->link_vid) }}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            @else
                <div class="flex items-center justify-center h-full text-white">
                    Video tidak tersedia
                </div>
            @endif
        </div>

        {{-- CONTENT --}}
        <div class="p-6 space-y-4">

            {{-- JUDUL --}}
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
                {{ $video->judul_vid ?? '-' }}
            </h1>

            {{-- DESKRIPSI --}}
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ $video->deskripsi_vid ?? 'Tidak ada deskripsi' }}
            </p>

            {{-- INFO META --}}
            <div class="flex items-center w-fit overflow-hidden rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm">

                {{-- LIKE --}}
                <form method="POST" action="{{ route('video.store') }}">
                    @csrf
                    <input type="hidden" name="id_vid" value="{{ $video->id_vid }}">
                    <input type="hidden" name="tipe" value="like">
                    <input type="hidden" name="action" value="react">

                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition">

                        👍
                        <span>{{ $totalLike }}</span>
                    </button>
                </form>

                <div class="h-6 border-r border-gray-300 dark:border-gray-600"></div>

                {{-- DISLIKE --}}
                <form method="POST" action="{{ route('video.store') }}">
                    @csrf
                    <input type="hidden" name="id_vid" value="{{ $video->id_vid }}">
                    <input type="hidden" name="tipe" value="dislike">
                    <input type="hidden" name="action" value="react">

                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition">

                        👎
                        <span>{{ $totalDislike }}</span>
                    </button>
                </form>

            </div>

            <div class="mt-8">

                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-400">
                    Komentar
                </h3>

                <form method="POST" action="{{ route('video.store') }}">
                    @csrf

                    <input type="hidden" name="id_vid" value="{{ $video->id_vid }}">
                    <input type="hidden" name="action" value="komen">

                    <textarea
                        name="komentar"
                        rows="3"
                        required
                        class="w-full rounded-lg border p-3 dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                        placeholder="Tulis komentar..."></textarea>

                    <button
                        type="submit"
                        class="mt-3 px-5 py-2 rounded-lg bg-brand-500 text-white">
                        Kirim Komentar
                    </button>

                </form>

            </div>

            <div class="mt-8 space-y-4">

                @forelse($komentar as $item)

                    <div class="p-4 border rounded-xl dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">

                        <div class="flex justify-between">

                            <h4 class="font-semibold">
                                {{ $item->name }}
                            </h4>

                            <small class="text-gray-500">
                                {{ $item->created_at }}
                            </small>

                        </div>

                        <p class="mt-2 text-gray-600">
                            {{ $item->komen_vid_dt }}
                        </p>

                    </div>

                @empty

                    <div class="text-gray-500">
                        Belum ada komentar.
                    </div>

                @endforelse

            </div>            

        </div>
    </div>

</div>

@endsection