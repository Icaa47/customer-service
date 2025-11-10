<div>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-6 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Tambah Rekapan Closing</h2>
                    <a href="{{ route('rekapan.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">
                        Kembali
                    </a>
                </div>

                <div class="px-6 py-6">
                    <form wire:submit.prevent="save" class="space-y-6">
                        <div>
                            <label for="klien" class="block text-sm font-medium text-gray-700">Klien</label>
                            <input type="text" id="klien" wire:model.defer="klien"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-600 focus:ring-navy-600"
                                placeholder="Nama klien">
                            @error('klien')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bisnis" class="block text-sm font-medium text-gray-700">Bisnis</label>
                            <input type="text" id="bisnis" wire:model.defer="bisnis"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-600 focus:ring-navy-600"
                                placeholder="Nama bisnis">
                            @error('bisnis')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="paket" class="block text-sm font-medium text-gray-700">Paket</label>
                            <input type="text" id="paket" wire:model.defer="paket"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-600 focus:ring-navy-600"
                                placeholder="Jenis paket">
                            @error('paket')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="produk" class="block text-sm font-medium text-gray-700">Produk</label>
                            <input type="text" id="produk" wire:model.defer="produk"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-600 focus:ring-navy-600"
                                placeholder="Produk yang diambil">
                            @error('produk')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                <input type="number" id="jumlah" wire:model.defer="jumlah" step="0.01" min="0"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-600 focus:ring-navy-600"
                                    placeholder="0.00">
                                @error('jumlah')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" wire:model.defer="status"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-600 focus:ring-navy-600">
                                    <option value="">Pilih status</option>
                                    @foreach ($availableStatuses as $availableStatus)
                                        <option value="{{ $availableStatus }}">{{ $availableStatus }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-navy-700 text-white rounded-lg text-sm font-medium hover:bg-navy-800 transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
