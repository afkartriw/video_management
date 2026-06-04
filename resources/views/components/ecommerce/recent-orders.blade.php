@props(['request'])

@php

    $getStatusClasses = function($status) {
        $baseClasses = 'rounded-full px-2 py-0.5 text-theme-xs font-medium';

        return match($status) {
            'acc' => $baseClasses . ' bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500',
            'pending' => $baseClasses . ' bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400',
            'expaide' => $baseClasses . ' bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500',
            default => $baseClasses . ' bg-gray-50 text-gray-600 dark:bg-gray-500/15 dark:text-gray-400',
        };
    };
@endphp


<div class="h-118 overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
    <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Request</h3>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('request.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                See all
            </a>
        </div>
    </div>

    <div class="h-full overflow-y-auto custom-scrollbar">
        <table class="min-w-full">
            <thead>
                <tr class="border-t border-gray-100 dark:border-gray-800">
                    <th class="py-3 text-left">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Customer</p>
                    </th>
                    <th class="py-3 text-left">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Video</p>
                    </th>
                    <th class="py-3 text-left">
                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($request as $req)
                    <tr class="border-t border-gray-100 dark:border-gray-800">

                        <td class="py-3 whitespace-nowrap">
                            <div class="flex items-center gap-3">

                                <div class="h-[30px] w-[30px] overflow-hidden rounded-md">
                                    <img src="images/user/profil.jpg" alt="{{ $req->name }}" />
                                </div>

                                <div>
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $req->name }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td class="py-3 whitespace-nowrap">
                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                {{ $req->judul_vid }}
                            </p>
                        </td>

                        <td class="py-3 whitespace-nowrap">
                            <span class="{{ $getStatusClasses($req->status_req) }}">
                                {{ $req->status_req }}
                            </span>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>