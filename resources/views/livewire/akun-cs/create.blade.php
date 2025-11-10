<div>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-6 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Tambah Akun Customer Service</h2>
                    <a href="{{ route('akun-cs.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">
                        Kembali
                    </a>
                </div>

                <div class="px-6 py-6 space-y-6">
                    @if (session('status'))
                        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="save" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="name" wire:model.defer="name"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-600 focus:ring-navy-600"
                                placeholder="Nama lengkap CS">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" wire:model.defer="email"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-600 focus:ring-navy-600"
                                placeholder="email@perusahaan.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select id="role" wire:model.defer="role"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-navy-600 focus:ring-navy-600">
                                @foreach ($availableRoles as $availableRole)
                                    <option value="{{ $availableRole }}">{{ $availableRole }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password Sementara</label>
                            <div class="mt-1 flex gap-3">
                                <input type="text" id="password" wire:model="passwordPreview" readonly
                                    class="flex-1 rounded-lg border-gray-300 bg-gray-100 shadow-sm focus:border-navy-600 focus:ring-navy-600"
                                    placeholder="Password sementara akan muncul di sini">
                                <button type="button" wire:click="regeneratePassword"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-navy-700 text-white rounded-lg text-sm font-medium hover:bg-navy-800 transition">
                                    Regenerasi
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-navy-700 text-white rounded-lg text-sm font-medium hover:bg-navy-800 transition">
                                Simpan Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
