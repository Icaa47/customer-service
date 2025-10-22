<div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        {{-- Header Halaman (Opsional, sesuaikan jika perlu) --}}
                        {{-- <h1 class="text-3xl font-bold text-indigo-900 mb-6">Dashboard</h1> --}}

                        {{-- Stats Cards (Kode dari Rekapan) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                            {{-- Card 1: Closing Harian --}}
                            <div class="bg-white p-6 rounded-lg shadow-sm flex items-center justify-between">
                                <div>
                                    <span class="text-sm font-medium text-gray-500">Closing Harian</span>
                                    <p class="text-3xl font-bold text-gray-800">{{ $closingHarian }}</p>
                                </div>
                                <div class="w-14 h-14 rounded-full flex items-center justify-center bg-yellow-100">
                                    <i class="bi bi-cart3 text-2xl text-yellow-600"></i>
                                </div>
                            </div>
                            {{-- Card 2: Closing Bulanan --}}
                            <div class="bg-white p-6 rounded-lg shadow-sm flex items-center justify-between">
                                <div>
                                    <span class="text-sm font-medium text-gray-500">Closing Bulanan</span>
                                    <p class="text-3xl font-bold text-gray-800">{{ $closingBulanan }}</p>
                                </div>
                                <div class="w-14 h-14 rounded-full flex items-center justify-center bg-indigo-100">
                                    <i class="bi bi-calendar-event-fill text-2xl text-indigo-600"></i>
                                </div>
                            </div>
                            {{-- Card 3: Rekapitulasi --}}
                            <div class="bg-white p-6 rounded-lg shadow-sm flex items-center justify-between">
                                <div>
                                    <span class="text-sm font-medium text-gray-500">Rekapitulasi</span>
                                    <p class="text-3xl font-bold text-green-600">Rp. {{ $rekapitulasi }}</p>
                                </div>
                                <div class="w-14 h-14 rounded-full flex items-center justify-center bg-green-100">
                                    <i class="bi bi-currency-dollar text-2xl text-green-600"></i>
                                </div>
                            </div>
                        </div>

                        {{-- --------------------------------- --}}
                        {{-- Tabel 1: Detail Closingan         --}}
                        {{-- --------------------------------- --}}
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8"> {{-- Tambah margin-bottom --}}
                            {{-- Header Tabel Closingan --}}
                            <div class="p-6 flex justify-between items-center">
                                <h2 class="text-xl font-semibold text-gray-800">Detail Closingan</h2>
                                <div class="flex items-center gap-3">
                                    <button
                                        class="flex items-center gap-2 px-4 py-2 bg-indigo-900 text-white rounded-lg text-sm font-medium hover:bg-indigo-800 transition">
                                        <i class="bi bi-sliders"></i>
                                        <span>Filter</span>
                                    </button>
                                    <button
                                        class="flex items-center gap-2 px-4 py-2 bg-indigo-900 text-white rounded-lg text-sm font-medium hover:bg-indigo-800 transition">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                        <span>Export</span>
                                    </button>
                                </div>
                            </div>
                            {{-- Tabel Closingan --}}
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Klien</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Produk</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Jumlah</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Waktu</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($closings as $closing)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $closing['klien'] }}</div>
                                                    <div class="text-sm text-gray-500">({{ $closing['bisnis'] }})</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $closing['produk'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $closing['jumlah'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $closing['waktu'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $statusClass = '';
                                                        if ($closing['status'] == 'Selesai') {
                                                            $statusClass = 'bg-green-100 text-green-800';
                                                        } elseif ($closing['status'] == 'Gagal') {
                                                            $statusClass = 'bg-red-100 text-red-800';
                                                        } elseif ($closing['status'] == 'Pending') {
                                                            $statusClass = 'bg-yellow-100 text-yellow-800';
                                                        }
                                                    @endphp
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                        {{ $closing['status'] }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">Tidak
                                                    ada data closingan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- Paginasi Closingan --}}
                            @if ($closings->hasPages())
                                <div class="p-4 border-t border-gray-200">
                                    {{ $closings->links(data: ['pageName' => 'closingPage']) }} {{-- PENTING: Tentukan pageName --}}
                                </div>
                            @endif
                        </div>

                        {{-- --------------------------------- --}}
                        {{-- Tabel 2: Akun CS                  --}}
                        {{-- --------------------------------- --}}
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            {{-- Header Tabel Akun CS (Search & Tambah) --}}
                            <div class="p-6 flex flex-col md:flex-row justify-between items-center gap-4">
                                <h2 class="text-xl font-semibold text-gray-800 w-full md:w-auto mb-4 md:mb-0">Akun CS
                                </h2>
                                <div class="w-full md:w-auto flex flex-col md:flex-row items-center gap-3">
                                    {{-- Search Input Akun CS --}}
                                    <div class="relative w-full md:w-64">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <i class="bi bi-search text-gray-400"></i>
                                        </span>
                                        <input wire:model.live.debounce.300ms="search" type="text"
                                            placeholder="Cari Akun CS..."
                                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm shadow-sm">
                                    </div>
                                    {{-- Tombol Tambah Data Akun CS --}}
                                    <a href="#"
                                        class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-900 text-white rounded-lg text-sm font-medium hover:bg-indigo-800 transition shadow-sm">
                                        <i class="bi bi-plus-lg"></i>
                                        <span>Tambah Data</span>
                                    </a>
                                </div>
                            </div>

                            {{-- Tabel Akun CS --}}
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nama</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Email</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Role</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($users as $user)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ $user['nama'] }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $user['email'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $user['role'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $statusClass =
                                                            $user['status'] == 'Aktif'
                                                                ? 'bg-green-100 text-green-800'
                                                                : 'bg-red-100 text-red-800';
                                                    @endphp
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                        {{ $user['status'] }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-3">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                                        title="Edit">
                                                        <i class="bi bi-pencil-square text-lg"></i>
                                                    </a>
                                                    <button type="button" class="text-red-600 hover:text-red-900"
                                                        title="Delete">
                                                        <i class="bi bi-trash3-fill text-lg"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                                                    @if (empty($search))
                                                        Tidak ada data Akun CS.
                                                    @else
                                                        Tidak ada hasil untuk pencarian "{{ $search }}".
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Paginasi Akun CS --}}
                            @if ($users->hasPages())
                                <div class="p-4 border-t border-gray-200">
                                    {{ $users->links(data: ['pageName' => 'userPage']) }} {{-- PENTING: Tentukan pageName --}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
