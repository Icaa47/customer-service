<div class="relative" x-data="{ open: false }">
    <button @click="open = !open"
        class="relative p-2 text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-navy-500">
        <span class="sr-only">View notifications</span>
        <svg class="w-6 h-6" xmlns="http://www.w3/org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        @if ($pendingCount > 0)
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
                <h3 class="text-lg font-medium text-gray-900">Permintaan Koreksi Poin</h3>
            </div>

            {{-- INI PENTING: Menambahkan scroll jika daftar panjang --}}
            <div class="overflow-y-auto max-h-96">

                @forelse ($pendingRequests as $request)
                    <div class="p-4 border-b border-gray-200">
                        <p class="text-sm font-medium text-gray-900">
                            Dari: {{ $request->requester->name }}
                        </p>
                        <p class="text-sm text-gray-700">
                            Untuk: <span class="font-semibold">{{ $request->user->name }}</span>
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            Catatan: "{{ $request->notes ?? 'Tidak ada catatan' }}"
                        </p>
                        <div class="flex gap-2 mt-3">

                            {{-- Tombol-tombol ini sekarang akan berfungsi --}}
                            <button wire:click="approve({{ $request->id }})"
                                class="w-full px-3 py-1 text-sm text-white bg-green-600 rounded-md hover:bg-green-700">
                                Setuju
                            </button>
                            <button wire:click="reject({{ $request->id }})"
                                class="w-full px-3 py-1 text-sm text-white bg-red-600 rounded-md hover:bg-red-700">
                                Tolak
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">
                        Tidak ada permintaan baru.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
