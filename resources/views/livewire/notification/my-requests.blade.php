<div class="relative" x-data="{ open: false }">
    <button @click="open = !open"
        class="relative p-2 text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-navy-500">
        <span class="sr-only">View notifications</span>
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-1.414 1.414a1 1 0 01-1.414 0l-1.414-1.414A1 1 0 009.586 13H4" />
        </svg>

        @if ($unreadCount > 0)
            <span
                class="absolute top-0 right-0 block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full ring-2 ring-white"></span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" {{-- INI PENTING: z-50 menempatkannya di paling atas --}}
        class="absolute right-0 z-50 w-screen max-w-sm mt-2 origin-top-right transform" style="display: none;">
        <div class="overflow-hidden bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
            <div class="p-4">
                <h3 class="text-lg font-medium text-gray-900">Status Permintaan Saya</h3>
            </div>

            {{-- INI PENTING: Menambahkan scroll jika daftar panjang --}}
            <div class="overflow-y-auto max-h-96">

                @forelse ($myRequests as $request)
                    <div class="p-4 border-b border-gray-200 @if (!$request->read_at) bg-blue-50 @endif">
                        <div class="flex items-center justify-between">
                            <p class_alias="text-sm font-medium text-gray-900">
                                Request untuk: {{ $request->user->name }}
                            </p>
                            @if ($request->status == 'approved')
                                <span
                                    class="px-2 py-0.5 text-xs font-medium text-green-800 bg-green-100 rounded-full">Disetujui</span>
                            @else
                                <span
                                    class="px-2 py-0.5 text-xs font-medium text-red-800 bg-red-100 rounded-full">Ditolak</span>
                            @endif
                        </div>
                        <p class="mt-1 text-sm text-gray-500">
                            Dikirim: {{ $request->created_at->diffForHumans() }}
                        </p>
                        @if (!$request->read_at)
                            <button wire:click="markAsRead({{ $request->id }})"
                                class="mt-2 text-sm font-medium text-blue-600 hover:text-blue-500">
                                Tandai sudah dibaca
                            </button>
                        @endif
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">
                        Tidak ada notifikasi.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
