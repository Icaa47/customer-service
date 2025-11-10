<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($statCards as $card)
                <article
                    class="bg-white border border-gray-100 rounded-3xl shadow-sm p-3 flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
                    <div class="space-y-3">
                        <div class="text-[14px] font-medium text-gray-900">{{ $card['title'] }}</div>
                        <div class="text-[25px] font-semibold text-gray-900">{{ $card['value'] }}</div>
                        <div class="text-[15px] text-gray-400">{{ $card['subtitle'] }}</div>
                        <div
                            class="flex items-center text-[12px] gap-2 text-sm
                            @switch($card['trend']['direction'])
                                @case('down') text-rose-400 @break
                                @case('flat') text-gray-400 @break
                                @default text-emerald-500
                            @endswitch">
                            @switch($card['trend']['direction'])
                                @case('down')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 fill-current">
                                        <path
                                            d="M12 3a1 1 0 0 1 1 1v12.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 1 1 1.4-1.42L11 16.59V4a1 1 0 0 1 1-1Z" />
                                    </svg>
                                @break

                                @case('flat')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 fill-current">
                                        <path d="M4 11h16a1 1 0 1 1 0 2H4a1 1 0 1 1 0-2Z" />
                                    </svg>
                                @break

                                @default
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 fill-current">
                                        <path
                                            d="M12 21a1 1 0 0 1-1-1V7.41L7.7 10.7a1 1 0 0 1-1.4-1.42l5-5a1 1 0 0 1 1.4 0l5 5a1 1 0 0 1-1.4 1.42L13 7.41V20a1 1 0 0 1-1 1Z" />
                                    </svg>
                            @endswitch
                            <span class="font-medium">{{ $card['trend']['label'] }}</span>
                        </div>
                    </div>
                    <div class="self-start md:self-center">
                        @php
                            $accentClasses = $card['accent'];
                        @endphp
                        <span
                            class="inline-flex h-16 w-16 items-center justify-center rounded-2xl {{ $accentClasses }}">
                            @switch($card['icon'])
                                @case('wallet')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                        class="h-90 w-90 fill-current bg-[#00C707] bg-opacity-15 rounded-full">
                                        <path
                                            d="M20.8278 16.8333C19.9095 17.5216 19.4945 18.3466 19.4945 19.1166C19.4945 19.8883 19.9095 20.7133 20.8278 21.4033C21.7478 22.0933 23.0945 22.5699 24.6528 22.5699C25.0948 22.5699 25.5188 22.7455 25.8313 23.0581C26.1439 23.3706 26.3195 23.7946 26.3195 24.2366C26.3195 24.6786 26.1439 25.1025 25.8313 25.4151C25.5188 25.7277 25.0948 25.9033 24.6528 25.9033C22.4428 25.9033 20.3778 25.2333 18.8278 24.0699C17.2778 22.9066 16.1611 21.1733 16.1611 19.1183C16.1611 17.0616 17.2778 15.3283 18.8278 14.1649C20.3778 13.0033 22.4445 12.3333 24.6528 12.3333C28.0745 12.3333 31.3095 13.9716 32.5961 16.6999C32.6895 16.898 32.7429 17.1125 32.7533 17.3312C32.7638 17.55 32.731 17.7686 32.657 17.9747C32.5829 18.1807 32.469 18.3702 32.3217 18.5322C32.1745 18.6943 31.9967 18.8257 31.7986 18.9191C31.6006 19.0124 31.386 19.0659 31.1673 19.0763C30.9486 19.0867 30.7299 19.054 30.5239 18.9799C30.3178 18.9059 30.1283 18.792 29.9663 18.6447C29.8043 18.4974 29.6728 18.3197 29.5795 18.1216C28.9961 16.8766 27.1761 15.6666 24.6545 15.6666C23.0961 15.6666 21.7478 16.1433 20.8278 16.8333Z"
                                            fill="#00C707" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M20.8278 16.8333C19.9095 17.5216 19.4945 18.3466 19.4945 19.1166C19.4945 19.8883 19.9095 20.7133 20.8278 21.4033C21.7478 22.0933 23.0945 22.5699 24.6528 22.5699C25.0948 22.5699 25.5188 22.7455 25.8313 23.0581C26.1439 23.3706 26.3195 23.7946 26.3195 24.2366C26.3195 24.6786 26.1439 25.1025 25.8313 25.4151C25.5188 25.7277 25.0948 25.9033 24.6528 25.9033C22.4428 25.9033 20.3778 25.2333 18.8278 24.0699C17.2778 22.9066 16.1611 21.1733 16.1611 19.1183C16.1611 17.0616 17.2778 15.3283 18.8278 14.1649C20.3778 13.0033 22.4445 12.3333 24.6528 12.3333C28.0745 12.3333 31.3095 13.9716 32.5961 16.6999C32.6895 16.898 32.7429 17.1125 32.7533 17.3312C32.7638 17.55 32.731 17.7686 32.657 17.9747C32.5829 18.1807 32.469 18.3702 32.3217 18.5322C32.1745 18.6943 31.9967 18.8257 31.7986 18.9191C31.6006 19.0124 31.386 19.0659 31.1673 19.0763C30.9486 19.0867 30.7299 19.054 30.5239 18.9799C30.3178 18.9059 30.1283 18.792 29.9663 18.6447C29.8043 18.4974 29.6728 18.3197 29.5795 18.1216C28.9961 16.8766 27.1761 15.6666 24.6545 15.6666C23.0961 15.6666 21.7478 16.1433 20.8278 16.8333Z"
                                            fill="#00C707" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M27.9275 31.6383C28.8459 30.95 29.2592 30.125 29.2592 29.355C29.2592 28.5833 28.8459 27.7567 27.9259 27.0683C27.0075 26.3783 25.6592 25.9017 24.1025 25.9017C23.6605 25.9017 23.2366 25.7261 22.924 25.4135C22.6114 25.101 22.4359 24.677 22.4359 24.235C22.4359 23.793 22.6114 23.3691 22.924 23.0565C23.2366 22.7439 23.6605 22.5683 24.1025 22.5683C26.3125 22.5683 28.3775 23.2383 29.9275 24.4017C31.4775 25.565 32.5925 27.2983 32.5925 29.3533C32.5925 31.4083 31.4775 33.1433 29.9259 34.305C28.3759 35.4683 26.3125 36.1383 24.1025 36.1383C20.6809 36.1383 17.4442 34.5 16.1592 31.77C15.9707 31.3702 15.9487 30.9119 16.0981 30.4958C16.2475 30.0798 16.556 29.7402 16.9559 29.5517C17.3557 29.3631 17.814 29.3412 18.23 29.4906C18.646 29.64 18.9857 29.9485 19.1742 30.3483C19.7609 31.595 21.5809 32.805 24.1025 32.805C25.6609 32.805 27.0075 32.3283 27.9275 31.6383ZM24.3325 9C24.7745 9 25.1985 9.17559 25.511 9.48816C25.8236 9.80072 25.9992 10.2246 25.9992 10.6667V12.3333C25.9992 12.7754 25.8236 13.1993 25.511 13.5118C25.1985 13.8244 24.7745 14 24.3325 14C23.8905 14 23.4666 13.8244 23.154 13.5118C22.8414 13.1993 22.6659 12.7754 22.6659 12.3333V10.6667C22.6659 10.2246 22.8414 9.80072 23.154 9.48816C23.4666 9.17559 23.8905 9 24.3325 9Z"
                                            fill="#00C707" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M24.3327 34C24.7747 34 25.1986 34.1756 25.5112 34.4882C25.8238 34.8007 25.9993 35.2246 25.9993 35.6667V37.3333C25.9993 37.7754 25.8238 38.1993 25.5112 38.5118C25.1986 38.8244 24.7747 39 24.3327 39C23.8907 39 23.4667 38.8244 23.1542 38.5118C22.8416 38.1993 22.666 37.7754 22.666 37.3333V35.6667C22.666 35.2246 22.8416 34.8007 23.1542 34.4882C23.4667 34.1756 23.8907 34 24.3327 34Z"
                                            fill="#00C707" />
                                    </svg>
                                @break

                                @case('chart')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                        class="h-90 w-90 fill-current bg-[#0000FF] bg-opacity-15 rounded-full">
                                        <path
                                            d="M17.7893 32.6364L38.3707 12L41 14.7273L17.7893 38L7 27.1818L9.72 24.4545L17.7893 32.6364Z"
                                            fill="#0000FF" />
                                    </svg>
                                @break

                                @case('customers')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                        class="h-90 w-90 fill-current bg-[#E6A900] bg-opacity-15 rounded-full">
                                        <path
                                            d="M24.5 12C22.9075 12 21.5478 12.5634 20.421 13.6902C19.2942 14.817 18.7308 16.1767 18.7308 17.7692C18.7308 19.3618 19.2942 20.7215 20.421 21.8483C21.5478 22.9751 22.9075 23.5385 24.5 23.5385C26.0925 23.5385 27.4522 22.9751 28.579 21.8483C29.7058 20.7215 30.2692 19.3618 30.2692 17.7692C30.2692 16.1767 29.7058 14.817 28.579 13.6902C27.4522 12.5634 26.0925 12 24.5 12ZM24.5 25.4615C25.6218 25.4615 26.7586 25.5717 27.9105 25.7921C29.0623 26.0124 30.1841 26.3605 31.2758 26.8362C32.3676 27.312 33.3366 27.8829 34.183 28.549C35.0293 29.215 35.7104 30.0288 36.2263 30.9904C36.7421 31.9519 37 32.9936 37 34.1154C37 34.8666 36.7145 35.5352 36.1436 36.1211C35.5727 36.707 34.8966 37 34.1154 37H14.8846C14.1034 37 13.4273 36.707 12.8564 36.1211C12.2855 35.5352 12 34.8666 12 34.1154C12 32.9936 12.2579 31.9519 12.7737 30.9904C13.2896 30.0288 13.9707 29.215 14.817 28.549C15.6634 27.8829 16.6324 27.312 17.7242 26.8362C18.8159 26.3605 19.9377 26.0124 21.0895 25.7921C22.2414 25.5717 23.3782 25.4615 24.5 25.4615Z"
                                            fill="#E6A900" />
                                    </svg>
                                @break

                                @case('support')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                        class="h-90 w-90 fill-current bg-[#FB0000] bg-opacity-15 rounded-full">
                                        <path
                                            d="M36.1818 16.8626C36.9292 16.8626 37.6461 17.1595 38.1746 17.6881C38.7031 18.2166 39 18.9335 39 19.6809V25.3176C39 26.065 38.7031 26.7819 38.1746 27.3104C37.6461 27.8389 36.9292 28.1359 36.1818 28.1359H34.6854C34.3418 30.8602 33.016 33.3655 30.9566 35.1817C28.8971 36.9978 26.2458 38 23.5 38V35.1817C25.7423 35.1817 27.8927 34.2909 29.4783 32.7053C31.0638 31.1197 31.9545 28.9691 31.9545 26.7267V18.2718C31.9545 16.0294 31.0638 13.8788 29.4783 12.2932C27.8927 10.7076 25.7423 9.8168 23.5 9.8168C21.2577 9.8168 19.1073 10.7076 17.5217 12.2932C15.9362 13.8788 15.0455 16.0294 15.0455 18.2718V28.1359H10.8182C10.0708 28.1359 9.35394 27.8389 8.82543 27.3104C8.29691 26.7819 8 26.065 8 25.3176V19.6809C8 18.9335 8.29691 18.2166 8.82543 17.6881C9.35394 17.1595 10.0708 16.8626 10.8182 16.8626H12.3146C12.6585 14.1385 13.9845 11.6336 16.0439 9.81776C18.1033 8.00192 20.7545 7 23.5 7C26.2455 7 28.8967 8.00192 30.9561 9.81776C33.0155 11.6336 34.3415 14.1385 34.6854 16.8626H36.1818ZM17.5255 27.8329L19.0191 25.443C20.3621 26.2843 21.9153 26.7293 23.5 26.7267C25.0847 26.7293 26.6379 26.2843 27.9809 25.443L29.4745 27.8329C27.684 28.9548 25.613 29.5483 23.5 29.545C21.387 29.5484 19.316 28.9549 17.5255 27.8329Z"
                                            fill="#FB0000" />
                                    </svg>
                                @break

                                @default
                                    <x-icons.dashboard class="h-9 w-9" />
                            @endswitch
                        </span>
                    </div>
                </article>
            @endforeach
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2">
                <div class="bg-white border border-gray-100 rounded-3xl shadow-sm">
                    <div
                        class="flex flex-col gap-1 md:flex-row md:items-center md:justify-between px-6 py-5 border-b border-gray-100">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Rekapan Closingan Terbaru</h2>
                            <p class="text-sm text-gray-500">Diperbarui {{ $lastUpdatedAt }}</p>
                        </div>
                        <span
                            class="text-xs font-medium text-indigo-500 bg-indigo-50 px-3 py-1 rounded-full">{{ $currentPeriod }}</span>
                    </div>

                    <div class="px-2 pb-6 sm:px-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-100">
                                <thead class="text-left text-xs font-semibold uppercase tracking-wider text-gray-400">
                                    <tr>
                                        <th class="px-4 py-3">No</th>
                                        <th class="px-4 py-3">Nama</th>
                                        <th class="px-4 py-3">Produk</th>
                                        <th class="px-4 py-3">Jumlah</th>
                                        <th class="px-4 py-3">Tanggal</th>
                                        <th class="px-4 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                                    @forelse ($closings as $closing)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-4 py-4 align-top text-gray-400">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-4 align-top">
                                                <div class="font-semibold text-gray-800">
                                                    {{ optional($closing->user)->name ?? 'Tidak diketahui' }}</div>
                                                <div class="text-xs text-gray-400">{{ $closing->bisnis }}</div>
                                            </td>
                                            <td class="px-4 py-4 align-top">
                                                <div class="font-medium text-gray-700">{{ $closing->produk }}</div>
                                                <div class="text-xs text-gray-400">Paket {{ $closing->paket }}</div>
                                            </td>
                                            <td class="px-4 py-4 align-top font-semibold text-gray-800">
                                                Rp {{ number_format((float) $closing->jumlah, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-4 align-top">
                                                {{ optional($closing->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                            </td>
                                            <td class="px-4 py-4 align-top">
                                                @php
                                                    $statusColors = [
                                                        'Selesai' => 'bg-emerald-100 text-emerald-600',
                                                        'Pending' => 'bg-amber-100 text-amber-600',
                                                        'Gagal' => 'bg-rose-100 text-rose-600',
                                                    ];
                                                    $statusClass =
                                                        $statusColors[$closing->status] ?? 'bg-gray-100 text-gray-500';
                                                @endphp
                                                <span
                                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                                    <span class="h-2 w-2 rounded-full bg-current"></span>
                                                    {{ $closing->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 py-10 text-center text-sm text-gray-500">
                                                Belum ada data closingan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white border border-gray-100 rounded-3xl shadow-sm h-full">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-800">Performa CS</h2>
                        <p class="text-sm text-gray-500">Periode {{ $currentPeriod }}</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-5">
                            @forelse ($performances as $perf)
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-100 to-indigo-200 text-indigo-600 font-semibold flex items-center justify-center">
                                            {{ mb_strtoupper(mb_substr($perf->name ?? 'CS', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800">{{ $perf->name }}</p>
                                            <div class="flex items-center gap-2 text-xs text-gray-400">
                                                <span
                                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full {{ $perf->status === 'Aktif' ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-500' }}">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                                    {{ $perf->status ?? 'Aktif' }}
                                                </span>
                                                <span>{{ $perf->total_closing ?? 0 }} closing</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-semibold text-gray-800">
                                            {{ $perf->total_pendapatan_formatted }}</div>
                                        <div class="text-xs text-gray-400">Rata-rata
                                            {{ number_format($perf->rata_rata_closing, 1, ',', '.') }} / hari</div>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center text-sm text-gray-500 py-10">
                                    Belum ada data performa CS untuk periode ini.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
