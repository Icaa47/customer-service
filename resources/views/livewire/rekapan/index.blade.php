{{-- TAMBAHAN: Bungkus semua dengan x-data --}}
<div x-data="{ showModal: false }">
    {{-- Konten Utama --}}
    <div class="py-12">
        <div class="sm:px-6 lg:px-8 grid grid-cols-3 max-w-7xl mx-auto gap-4">
            <div class="bg-white p-4 rounded-xl shadow-lg flex justify-between items-center">
                <div>
                    <p>Closing Harian</p>
                    <span class="text-4xl text-navy-700 font-medium">{{ $closingHarian }}</span>
                </div>
                <div
                    class="relative flex justify-center items-center w-16 h-16 bg-[#E6A900] bg-opacity-25 p-2 rounded-full">
                    <svg viewBox="0 0 46 43" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10">
                        <path
                            d="M40.25 34.6867V31.5333H13.225L14.95 28.38L41.4 25.8L46 8.6H10.6375L8.625 0H0V2.86667H6.325L12.3625 26.9467L8.625 34.4V38.7C8.625 40.9933 10.6375 43 12.9375 43C15.2375 43 17.25 40.9933 17.25 38.7C17.25 36.4067 15.2375 34.4 12.9375 34.4H34.5V38.7C34.5 40.9933 36.5125 43 38.8125 43C41.1125 43 43.125 40.9933 43.125 38.7C43.125 36.6933 41.975 35.26 40.25 34.6867Z"
                            fill="#E6A900" />
                    </svg>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-lg flex justify-between items-center">
                <div>
                    <p>Closing Bulanan</p>
                    <span class="text-4xl text-navy-700 font-medium">{{ $closingBulanan }}</span>
                </div>
                <div
                    class="relative flex justify-center items-center w-16 h-16 bg-[#000080] bg-opacity-25 p-2 rounded-full">
                    <svg viewBox="0 0 46 43" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10">
                        <path
                            d="M29.5885 23.1148V33.6393H19V23.1148H29.5885ZM27.4115 0H31.6667V4.22951H33.7448C34.9323 4.22951 35.9384 4.63934 36.763 5.45902C37.5877 6.27869 38 7.27869 38 8.45902V37.7705C38 38.9508 37.5877 39.9508 36.763 40.7705C35.9384 41.5902 34.9323 42 33.7448 42H4.25521C3.06771 42 2.06163 41.5902 1.23698 40.7705C0.412326 39.9508 0 38.9508 0 37.7705V8.45902C0 7.27869 0.412326 6.27869 1.23698 5.45902C2.06163 4.63934 3.06771 4.22951 4.25521 4.22951H6.33333V0H10.5885V4.22951H27.4115V0ZM33.7448 37.7705V14.7541H4.25521V37.7705H33.7448Z"
                            fill="#000080" />
                    </svg>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-lg flex justify-between items-center">
                <div>
                    <p>Rekapitulasi</p>
                    <span class="text-4xl text-navy-700 font-medium">{{ $rekapitulasi }}</span>
                </div>
                <div
                    class="relative flex justify-center items-center w-16 h-16 bg-[#00C707] bg-opacity-25 p-2 rounded-full">
                    <svg viewBox="0 0 30 45" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.64475 12.4028C6.19072 13.4927 5.53364 14.7989 5.53364 16.0181C5.53364 17.2399 6.19072 18.5462 7.64475 19.6387C9.10141 20.7312 11.2336 21.4859 13.701 21.4859C14.4009 21.4859 15.0721 21.7639 15.567 22.2588C16.0619 22.7537 16.3399 23.4249 16.3399 24.1248C16.3399 24.8247 16.0619 25.4959 15.567 25.9908C15.0721 26.4856 14.4009 26.7637 13.701 26.7637C10.2018 26.7637 6.93225 25.7028 4.47808 23.8609C2.02391 22.0189 0.255859 19.2745 0.255859 16.0207C0.255859 12.7644 2.02391 10.0199 4.47808 8.17797C6.93225 6.33867 10.2045 5.27783 13.701 5.27783C19.1186 5.27783 24.2407 7.87186 26.2779 12.1917C26.4257 12.5053 26.5103 12.845 26.5269 13.1913C26.5434 13.5376 26.4915 13.8838 26.3743 14.2101C26.257 14.5364 26.0767 14.8363 25.8435 15.0929C25.6103 15.3495 25.3289 15.5576 25.0152 15.7054C24.7016 15.8532 24.3619 15.9378 24.0156 15.9543C23.6693 15.9708 23.3232 15.919 22.9969 15.8018C22.6706 15.6845 22.3706 15.5041 22.114 15.2709C21.8575 15.0378 21.6494 14.7563 21.5016 14.4427C20.5779 12.4714 17.6963 10.5556 13.7036 10.5556C11.2363 10.5556 9.10141 11.3103 7.64475 12.4028Z"
                            fill="#00C707" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M18.8852 35.844C20.3393 34.7542 20.9937 33.4479 20.9937 32.2288C20.9937 31.0069 20.3393 29.6981 18.8826 28.6082C17.4286 27.5157 15.2937 26.761 12.829 26.761C12.1291 26.761 11.4579 26.4829 10.963 25.9881C10.4681 25.4932 10.1901 24.822 10.1901 24.1221C10.1901 23.4222 10.4681 22.751 10.963 22.2561C11.4579 21.7612 12.1291 21.4832 12.829 21.4832C16.3282 21.4832 19.5977 22.544 22.0519 24.386C24.5061 26.2279 26.2715 28.9724 26.2715 32.2261C26.2715 35.4799 24.5061 38.2269 22.0493 40.0663C19.5951 41.9082 16.3282 42.969 12.829 42.969C7.41135 42.969 2.28663 40.375 0.252045 36.0525C-0.0464526 35.4195 -0.0812511 34.6938 0.155305 34.0351C0.391861 33.3764 0.880394 32.8386 1.51343 32.5401C2.14647 32.2416 2.87216 32.2068 3.53086 32.4434C4.18955 32.68 4.7273 33.1685 5.02579 33.8015C5.95468 35.7754 8.83635 37.6913 12.829 37.6913C15.2964 37.6913 17.4286 36.9365 18.8852 35.844ZM13.1932 0C13.893 0 14.5642 0.278025 15.0591 0.772913C15.554 1.2678 15.832 1.93901 15.832 2.63889V5.27778C15.832 5.97765 15.554 6.64887 15.0591 7.14375C14.5642 7.63864 13.893 7.91667 13.1932 7.91667C12.4933 7.91667 11.8221 7.63864 11.3272 7.14375C10.8323 6.64887 10.5543 5.97765 10.5543 5.27778V2.63889C10.5543 1.93901 10.8323 1.2678 11.3272 0.772913C11.8221 0.278025 12.4933 0 13.1932 0Z"
                            fill="#00C707" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M13.1936 39.5834C13.8935 39.5834 14.5647 39.8614 15.0596 40.3563C15.5544 40.8512 15.8325 41.5224 15.8325 42.2223V44.8612C15.8325 45.561 15.5544 46.2322 15.0596 46.7271C14.5647 47.222 13.8935 47.5 13.1936 47.5C12.4937 47.5 11.8225 47.222 11.3276 46.7271C10.8327 46.2322 10.5547 45.561 10.5547 44.8612V42.2223C10.5547 41.5224 10.8327 40.8512 11.3276 40.3563C11.8225 39.8614 12.4937 39.5834 13.1936 39.5834Z"
                            fill="#00C707" />
                    </svg>
                </div>
            </div>
        </div>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="mt-2 text-sm text-gray-600">
                        <div class="rounded-lg overflow-hidden mt-8">
                            <div class="flex justify-between items-center">
                                <h2 class="text-xl font-semibold text-gray-800">Detail Closingan</h2>
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('rekapan.create') }}"
                                        class="flex items-center gap-2 px-4 py-2 bg-navy-700 text-white rounded-lg text-sm font-medium hover:bg-navy-800 transition">
                                        <x-icons.clipboard-list />
                                        <span>Tambah</span>
                                    </a>

                                    {{-- TAMBAHAN: Tambahkan @click di sini --}}
                                    <button @click="showModal = true" type="button" {{-- Pastikan type="button" agar tidak submit form --}}
                                        class="flex items-center gap-2 px-4 py-2 bg-navy-700 text-white rounded-lg text-sm font-medium hover:bg-navy-800 transition">
                                        <x-icons.filter />
                                        <span>Filter</span>
                                    </button>

                                    <button
                                        class="flex items-center gap-2 px-4 py-2 bg-navy-700 text-white rounded-lg text-sm font-medium hover:bg-navy-800 transition">
                                        <x-icons.pdf />
                                        <span>Export</span>
                                    </button>
                                </div>
                            </div>

                            <div class="overflow-x-auto ">
                                <table class="w-full min-w-full divide-y divide-gray-200 rounded-lg">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Klien</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Paket</th>
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
                                    <tbody class="bg-white divide-y divide-gray-200 rounded-lg">
                                        @forelse ($closings as $closing)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $closing['klien'] }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">({{ $closing['bisnis'] }})</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $closing['paket'] ?? '-' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $closing['produk'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $closing['jumlah'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ optional($closing->created_at)->translatedFormat('d M Y H:i') }}
                                                </td>
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
                                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                                    Tidak ada data.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="p-4 border-t border-gray-200">
                                {{ $closings->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- 
        ============================================================
        TAMBAHAN: KODE MODAL FILTER
        ============================================================
    --}}
    <div x-show="showModal" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
        {{-- Overlay Background --}}
        <div @click="showModal = false" class="fixed inset-0 bg-black/50 backdrop-blur-sm" aria-hidden="true"></div>

        {{-- Panel Modal --}}
        <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative w-full max-w-lg overflow-hidden bg-white rounded-2xl shadow-xl" @click.stop
            {{-- Mencegah klik di dalam modal menutup modal --}}>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900">
                    Filter
                </h3>

                {{-- Form Content --}}
                <div class="mt-6 space-y-4">
                    {{-- Baris 1: Tanggal & Jenis Rentang --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">TANGGAL</label>
                            <div class="relative mt-1">
                                <input type="text" name="tanggal" id="tanggal"
                                    class="block w-full rounded-md border-gray-300 shadow-sm pl-10 focus:border-navy-500 focus:ring-navy-500 sm:text-sm"
                                    placeholder="dd/mm/yy">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    {{-- Ganti dengan icon kalender Anda jika ada (misal: x-icons.calendar) --}}
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008v-.008zm2.25-2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="jenis_rentang" class="block text-sm font-medium text-gray-700">JENIS
                                RENTANG</label>
                            <select id="jenis_rentang" name="jenis_rentang"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 sm:text-sm">
                                <option>Rentang Tanggal</option>
                                <option>Harian</option>
                                <option>Bulanan</option>
                            </select>
                        </div>
                    </div>

                    {{-- Baris 2: Paket --}}
                    <div>
                        <label for="paket" class="block text-sm font-medium text-gray-700">PAKET</label>
                        <input type="text" name="paket" id="paket"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 sm:text-sm">
                    </div>

                    {{-- Baris 3: Keterangan --}}
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">KETERANGAN</label>
                        <input type="text" name="keterangan" id="keterangan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 sm:text-sm">
                    </div>

                    {{-- Baris 4: Status --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">STATUS</label>
                        <input type="text" name="status" id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-navy-500 focus:ring-navy-500 sm:text-sm">
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="mt-8 flex justify-end">
                    <button @click="showModal = false" {{-- Ganti ini dengan type="submit" jika ini adalah form --}} type="button"
                        class="flex items-center gap-2 px-6 py-3 bg-navy-700 text-white rounded-lg text-sm font-medium hover:bg-navy-800 transition shadow-md">
                        <x-icons.filter />
                        <span>Filter</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
